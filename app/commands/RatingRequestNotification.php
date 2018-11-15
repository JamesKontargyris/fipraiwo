<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RatingRequestNotification extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'rating:reminder';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send a reminder email to those who have not rated an IWO that was confirmed or cancelled 7 days ago';

	protected $subject;
	protected $data;
	protected $recipient;

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$eight_days_previous = date('Y-m-d', strtotime('8 days ago'));
		$six_days_previous = date('Y-m-d', strtotime('6 days ago'));

		// Find all IWOs that were updated seven days ago and that are either confirmed or cancelled
		$iwos = Workorder::where(function($query) use ($eight_days_previous, $six_days_previous)
		{
			$query->where('updated_at', '>', $eight_days_previous)
			      ->where('updated_at', '<', $six_days_previous);
		})->where(function($query)
		{
			$query->where('confirmed', '=', 1)
			      ->orWhere('cancelled', '=', 1);
		})->get();

		// Artisan info
		$this->info($iwos->count() . " IWO" . ($iwos->count() != 1 ? "s were" : " was") . " confirmed or cancelled 7 days ago.");

		// Loop through IWOs found
		foreach($iwos as $iwo)
		{
			// Artisan info spacer
			$this->info(' ');

			// Artisan info
			$this->info(Iwo_ref::where('iwo_id', '=', $iwo->id)->pluck('iwo_ref') . ': ' . $iwo->title);

			// Get all the users associated with this IWO
			$iwo_users = User::where('iwo_id', '=', $iwo->id)->get();

			foreach($iwo_users as $user)
			{
				// If the user has a Lead or Sub role, we need to check to see if they have submitted a rating
				if($user->hasRole('Lead') || $user->hasRole('Sub'))
				{
					if( ! Rating::where('iwo_id', '=', $iwo->id)->where('user_id', '=', $user->id)->first())
					{
						// No rating has been left by this user for this IWO

						// Artisan info
						$this->info('    ' . $user->name . ' has not rated this IWO');

						if( ! $user->rating_reminder_sent)
						{
							/**
							 * FORMAT DATA FOR EMAIL
							 */
							$data = [
								'recipient' => $user->email,
								// IWO is cancelled or confirmed?
								'cancelled_or_confirmed' => $iwo->cancelled ? 'cancelled' : 'confirmed',
								// Workorder details
								'form_data' => pretty_input( unserialize( $iwo->workorder ) ),
								// IWO ID
								'iwo_id' => $iwo->id,
								// IWO reference
								'iwo_ref'   => Iwo_ref::where('iwo_id', '=', $iwo->id)->pluck('iwo_ref'),
								// Workorder title
								'iwo_title' => $iwo->title,
								// User ID
								'user_id' => $user->id,
								// User email
								'email' => $user->email,
								// Confirmation code
								'confirmation' => Confirmation_code::where('iwo_id', '=', $iwo->id)->pluck('code')
							];

							//Send an email to lead and sub units plus copy contacts now the work order is confirmed
							Queue::push( '\Iwo\Workers\SendEmail@rating_reminder', $data );

							// Artisan info
							$this->info('     └ Email sent');

							$user->rating_reminder_sent = 1;
							$user->save();
						} else {
							// Artisan info
							$this->info('     └ Reminder email has already been sent');
						}


					}
				}
			}
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}
}
