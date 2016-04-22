<?php namespace GW2Heroes\Http\Controllers;

use Cache;
use GW2Heroes\Models\Character;
use GW2Heroes\Models\Specialization;
use GW2Heroes\Models\Traits;
use GW2Treasures\GW2Api\V2\Authentication\Exception\InvalidPermissionsException;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;

class CharacterController extends Controller {

    protected function getCharacterFromRequest( Request $request, $id, $function ) {
        $id = base_convert( $id, 36, 10 );

        /** @var Character $character */
        $character = Cache::remember('character.'.$id, 1, function() use ($id) {
            return Character::with('account', 'account.user', 'guild')->withTrashed()->find($id);
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
            ->orderBy('id', 'desc')
            ->get();

        return view('character.activities', compact('character', 'activities'));
    }

    public function getEquipment( Request $request, $id ) {
        $character = $this->getCharacterFromRequest( $request, $id, __FUNCTION__ );
        $equipment = $character->equipment()->with('item')->get()->keyBy('slot');

        return view('character.equipment', compact('character', 'equipment'));
    }

    public function getSpecializations( Request $request, $id ) {
        $character = $this->getCharacterFromRequest( $request, $id, __FUNCTION__ );

        // get equipped specs
        // TODO: this should be done by the updater
        $specializations = collect(Cache::remember('specs.'.$character->id, 30, function() use ($character) {
            try {
                return app('gw2api')->characters($character->account->api_key)
                    ->specializations($character->name)->get();
            } catch( InvalidPermissionsException $x ) {
                return null;
            }
        }));

        // get all the spec ids we need to load from the db
        $specs = $specializations->collapse()->pluck('id', 'id')->toArray();

        // load specs from db
        $specs = Specialization::whereIn('id', $specs)->with('traits')->get()->keyBy('id');

        // transform specializations for easy display in view
        // env -> spec -> tier -> slot -> trait
        // and store selected indexes to generate svg
        $specializations = $specializations->map(function($env) use ($specs) {
            return collect($env)->filter()->map(function($spec) use ($specs) {
                // array to store selected trait indexes for the background svg
                $traitIndexes = [];

                // the specialization model
                $specialization = $specs[$spec->id];

                // transform traits (group by tier -> slot)
                $traits = $specialization->traits->groupBy('tier')->map(function($traits, $tier) use ($spec, $specialization, &$traitIndexes) {
                    return $traits->groupBy('slot')->map(function($traits, $slot) use ($spec, $tier, $specialization, &$traitIndexes) {
                        return $traits->sortBy(function($trait) use ($specialization) {
                            // sort traits in the order they appear in spec->data->major_traits
                            // this also works for minor traits, because there is only one
                            return array_search($trait->id, $specialization->data_en->major_traits);
                        })->values()->map(function($trait, $index) use ($spec, $tier, $slot, &$traitIndexes) {
                            // the trait is selected if its minor or if its in character->specializations->traits
                            $selected = $slot === 'Minor' || in_array($trait->id, $spec->traits);
                            if( $selected ) {
                                $traitIndexes[$tier.'-'.$slot] = $index;
                            }

                            return (object)[
                                'selected' => $selected,
                                'trait' => $trait
                            ];
                        });
                    })->sortBy(function($_, $key) {
                        // make sure we return minor slot first
                        return array_search($key, ['Minor', 'Major']);
                    });
                });

                return (object)[
                    'specialization' => $specialization,
                    'selected' => $spec->traits,
                    'traits' => $traits,
                    'traitIndexes' => $traitIndexes
                ];
            });
        });

        return view('character.specializations', compact('character', 'specializations'));
    }
}
