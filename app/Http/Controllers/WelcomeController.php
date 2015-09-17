<?php namespace GW2Heroes\Http\Controllers;

use GW2Heroes\Models\Account;
use GW2Heroes\Models\Character;
use GW2Heroes\Models\User;
use Response;

class WelcomeController extends Controller {
	/**
	 * Create a new controller instance.
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index() {

		$userCount = User::count();
		$accountCount = Account::count();
		$characterCount = Character::count();

		return view('welcome')
			->with(compact('userCount', 'accountCount', 'characterCount'));
	}

}
