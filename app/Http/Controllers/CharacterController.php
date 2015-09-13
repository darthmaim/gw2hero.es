<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Models\Character;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

class CharacterController extends Controller {

    protected function getCharacterFromRequest( Request $request, $id, $function ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Character $character */
        $character = Cache::remember('character.'.$id, 1, function() use ($id) {
            return Character::with('account', 'account.user')->find($id);
        });

        $actionName = '\\'.__CLASS__.'@'.$function;
        $action = action( $actionName, $character->getActionData() );

        if( $action !== $request->url() ) {
            throw new HttpResponseException(
                redirect( $action, 301 )
            );
        }

        return $character;
    }

    public function getIndex( Request $request, $id ) {
        $character = $this->getCharacterFromRequest( $request, $id, __FUNCTION__ );

        return view('character.summary', compact('character'));
    }

    public function getStory( Request $request, $id ) {
        $character = $this->getCharacterFromRequest( $request, $id, __FUNCTION__ );

        return view('character.story', compact('character'));
    }

    public function getActivities( Request $request, $id ) {
        $character = $this->getCharacterFromRequest( $request, $id, __FUNCTION__ );

        $activities = $character->activities()
            ->with('character', 'account', 'user', 'user.accounts')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('character.activities', compact('character', 'activities'));
    }

    public function getEquipment( Request $request, $id ) {
        $character = $this->getCharacterFromRequest( $request, $id, __FUNCTION__ );
        $equipment = is_array( $character->equipment )
            ? collect($character->equipment)->keyBy('slot')
            : $character->equipment;

        return view('character.equipment', compact('character', 'equipment'));
    }
}
