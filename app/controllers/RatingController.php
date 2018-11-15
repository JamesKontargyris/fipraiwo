<?php


use Illuminate\Support\Facades\Redirect;
use Iwo\Exceptions\ManagementLoginException;

class RatingController extends BaseController {

	protected $page_title;
	protected $workorder;
	protected $user;

	public function __construct() {
		parent::__construct();

		if ( Input::get('iwo_id') ) {
			$this->workorder = Workorder::find( Input::get('iwo_id') );
			$this->workorder->pretty_workorder = pretty_input( unserialize( $this->workorder->workorder ) );
		}

		$this->user = Auth::user();

		//Set default page title
		$this->page_title = "IWO Rating";
	}

	/**
	 * Displays the rating form if all required data is passed in
	 */
	public function getIndex() {

		if( ! Input::get('confirmation') || ! Input::get('iwo_id') || ! Input::get('user_id') || ! Input::get('email'))
		{
			// Some of the required info is missing from the query string, so we can't rate the IWO
			Session::flash('error', 'Sorry, you do not have permission to access that page.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		// Does a rating already exist for this user / IWO combination?
		if(Rating::where('iwo_id', '=', Input::get('iwo_id'))->where('user_id', '=', Input::get('user_id'))->count() > 0)
		{
			// This user has already left a rating
			Session::flash('error', 'You have already rated this IWO.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		$this->workorder = Workorder::find( Input::get( 'iwo_id' ) );

		if( ! $this->workorder->confirmed && ! $this->workorder->cancelled)
		{
			// Workorder isn't cancelled or confirmed, so we can't rate it
			Session::flash('error', 'Sorry, the IWO is neither confirmed nor cancelled, so cannot be rated.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		if(User::where('id', '=', Input::get('user_id'))->pluck('email') != Input::get('email'))
		{
			// User email doesn't match up
			Session::flash('error', 'Sorry, you do not have permission to access that page.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		$current_user = User::where('id', '=', Input::get('user_id'))->first();

		if( ! $current_user->hasRole('Lead') && ! $current_user->hasRole('Sub'))
		{
			// User isn't a lead or sub contact
			Session::flash('error', 'Sorry, you do not have permission to access that page.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		if( Input::get('confirmation') != Confirmation_code::where('iwo_id', '=', Input::get('iwo_id'))->pluck('code'))
		{
			// Confirmation code is not correct
			Session::flash('error', 'Sorry, you do not have permission to access that page.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		return View::make( 'rating.rate' )->with( [
			'page_title' => $this->page_title,
			'workorder'  => $this->workorder,
			'user'       => $this->user
		] );
	}

	/**
	 * Processes the submitted rating data
	 */
	public function postIndex() {

		// Does a rating already exist for this user / IWO combination?
		if(Rating::where('iwo_id', '=', Input::get('iwo_id'))->where('user_id', '=', Input::get('user_id'))->count() > 0)
		{
			// This user has already left a rating
			Session::flash('error', 'You have already rated this IWO.');
			return Auth::check() ? Redirect::to('/manage/view') : Redirect::to('/');
		}

		if(intval(Input::get('rating')) > 0)
		{
			$starRating = intval(Input::get('rating'));
			$comment = trim(Input::get('comment'));
			$user = User::find(Input::get('user_id'));
			Rating::add_rating($starRating, $comment, Input::get('iwo_id'), Input::get('user_id'));

			Logger::add_log( 'New rating of ' . $starRating . ' out of 5 added.', 'standard', Input::get('iwo_id'), Input::get('user_id') );

			/**
			 * FORMAT DATA FOR EMAILS
			 */
			$data = [
				'form_data' => $this->workorder->pretty_workorder,
				// IWO id
				'iwo_id' => $this->workorder->id,
				//IWO reference
				'iwo_ref'   => Session::get( 'iwo_ref' ),
				//    Workorder title
				'iwo_title' => $this->workorder->title,
				// Name of user that submitted the rating
				'user_name' => $user->name,
				// Score given
				'score' => $starRating,
				// Any comments given
				'comment' => $comment
			];

			//Send an email to lead and sub units plus copy contacts now the work order is confirmed
			$data['recipient'] = $this->get_all_emails( $this->workorder->id, $this->workorder->formtype_id );
			Queue::push( '\Iwo\Workers\SendEmail@rating_added', $data );

			return Auth::check() ? Redirect::to( '/manage/view' )->with( 'message', 'Rating added.' ) : Redirect::to( '/' )->with( 'message', 'Rating added.' );
		}
		else {
			return Auth::check() ? Redirect::to( '/manage/view' )->with( 'error', 'Rating not added.' ) : Redirect::to( '/' )->with( 'error', 'Rating not added.' );
		}

	}

}