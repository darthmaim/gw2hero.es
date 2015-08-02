<?php namespace GW2Heroes\Http\Controllers;

use Auth;
use GW2Heroes\Account;
use GW2Heroes\Character;
use GW2Treasures\GW2Api\GW2Api;
use Input;

class HomeController extends Controller{

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 */
	public function __construct(){
		$this->middleware('auth');
	}

	public function index() {
        $activities = Auth::user()->activities()
			->with('character', 'account', 'user', 'user.accounts')
			->orderBy('created_at', 'desc')
			->get();

        $accounts = Auth::user()->accounts()
			->with('characters')
			->get();

		return view('home', compact('activities', 'accounts'));
	}

}
