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
	 *
	 * @return void
	 */
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index() {
        $accounts = Auth::user()->accounts()->with('characters')->get();
		return view('home', compact('accounts'));
	}

    public function addAccount() {
        $api_key = Input::get('api_key');

        $api = new GW2Api();
        $accountInfo = $api->account($api_key)->info();

        $account = Account::create([
            'guid' => $accountInfo->id,
            'name' => $accountInfo->name,
            'world' => $accountInfo->world,
            'api_key' => $api_key
        ]);

        Auth::user()->accounts()->save( $account );

        $characterInfos = $api->characters($api_key)->all();
        $characters = [];

        foreach( $characterInfos as $char ) {
            $characters[] = Character::create([
                'name' => $char->name,
                'race' => $char->race,
                'gender' => $char->gender,
                'profession' => $char->profession,
                'level' => $char->level
            ]);
        }

        $account->characters()->saveMany( $characters );

        return redirect( action('HomeController@index') );
    }

}
