<?php namespace GW2Heroes\Http\Controllers;

use Auth;
use GW2Heroes\Account;
use GW2Heroes\Character;
use GW2Treasures\GW2Api\GW2Api;
use Input;

class CharacterController extends Controller{
    public function getIndex( $name ) {
        $character = Character::where( 'name', '=', $name )->first();

        return view('character.index', compact('character'));
    }
}
