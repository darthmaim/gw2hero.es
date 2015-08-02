<?php namespace GW2Heroes\Http\Controllers;

use GW2Heroes\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller{
    public function getIndex( Request $request, $id ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Character $character */
        $character = Character::with('account', 'account.user')->find($id);

        if( $character->getUrl() !== $request->url() ) {
            return redirect( $character->getUrl(), 301 );
        }

        return view('character.index', compact('character'));
    }

    public function getActivities( Request $request, $id ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Character $character */
        $character = Character::with('account', 'account.user', 'activities', 'activities.account', 'activities.user', 'activities.user.accounts')->find($id);

        if( action( 'CharacterController@getActivities', $character->getActionData() ) !== $request->url() ) {
            return redirect()->action('CharacterController@getActivities', $character->getActionData(), 301);
        }

        return view('character.activities', compact('character'));
    }
}
