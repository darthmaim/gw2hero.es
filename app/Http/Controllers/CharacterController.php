<?php namespace GW2Heroes\Http\Controllers;

use GW2Heroes\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller{
    public function getIndex( Request $request, $id ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Character $character */
        $character = Character::with('account', 'account.user')->find($id);

        if( $character->getUrl() !== $request->url() ) {
            return redirect( $character->getUrl() );
        }

        return view('character.index', compact('character'));
    }
}
