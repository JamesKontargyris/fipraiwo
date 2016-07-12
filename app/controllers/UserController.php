<?php

use Iwo\Exceptions\CannotEditException;
use Iwo\Exceptions\UserNotFoundException;
use Iwo\Validation\AddUserValidator;
use Iwo\Validation\EditUserValidator;

class UserController extends \BaseController {

	protected $addUserValidator;
	protected $editUserValidator;

	function __construct(AddUserValidator $addUserValidator, EditUserValidator $editUserValidator )
	{
		parent::__construct();

		$this->addUserValidator = $addUserValidator;
		$this->editUserValidator = $editUserValidator;

	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = User::where('iwo_id', '=', 0)->where('id', '<>', Auth::user()->id)->orderBy('name')->get();

		$page_title = 'Online IWO System Users';
		return View::make( 'users.index' )->with( compact( 'items', 'page_title' ) );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$page_title = 'Add a User';
		$roles = Role::where('name', '=', 'Administrator')->orWhere('name', '=', 'Fipriot')->get();
		$role_options = [];
		foreach($roles as $role) $role_options[$role->id] = $role->name;
		return View::make('users.createedit')->with(compact('items', 'page_title', 'role_options'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
//		dd($input);
		$this->addUserValidator->validate( $input );

		if(User::addUser($input))
		{
			return Redirect::route('users.index')->with('message', 'User successfully added.');
		}
		else
		{
			return Redirect::route('users.index')->with('error', 'Error: user could not be added.');
		}
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 * @throws UserNotFoundException
	 */
	public function show($id)
	{
		if($user = $this->getUser($id))
		{
			return View::make('users.show')->with(compact('user'));
		}
		else
		{
			throw new UserNotFoundException;
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return Response
	 * @throws CannotEditException
	 * @throws UserNotFoundException
	 */
	public function edit($id)
	{
		if ( $this->editingCurrentUser( $id ) )
		{
			throw new CannotEditException();
		}

		if($user = $this->getUser($id))
		{
			$page_title = 'Edit User: ' . $user->name;
			return View::make('users.createedit')->with(compact('page_title', 'user'));
		}
		else
		{
			throw new UserNotFoundException();
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		$this->editUserValidator->validate( $input );

		if(User::editUser($id, $input))
		{
			return Redirect::route('users.index')->with('message', 'User successfully updated.');
		}
		else
		{
			return Redirect::route('users.index')->with('error', 'Error: user could not be updated.');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ( $user = $this->getUser( $id ) )
		{
			if(User::destroy($id))
			{
				return Redirect::route('users.index')->with('message', 'User successfully deleted.');
			}
			else
			{
				return Redirect::route('users.index')->with('error', 'Error: user could not be deleted.');
			}

		}

		return Redirect::route( 'users.index' )->with('error', 'Error: user could not be deleted.');
	}


	/**
	 * Get the user we're trying to modify/view.
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Support\Collection|static
	 */
	protected function getUser( $id )
	{
		return User::find( $id );
	}

	/**
	 * Are we trying to edit the currently logged-in user?
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	private function editingCurrentUser( $id )
	{
		return ( $id == Auth::user()->id );
	}


}
