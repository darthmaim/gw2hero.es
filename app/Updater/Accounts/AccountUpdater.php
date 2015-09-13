<?php

namespace GW2Heroes\Updater\Accounts;

use Carbon\Carbon;
use GW2Heroes\Models\Account;
use GW2Heroes\Models\Activity;
use GW2Heroes\Models\Character;
use GW2Heroes\Updater\Character\CharacterUpdatePayload;
use GW2Heroes\Updater\Character\UpdatesCharacter;
use GW2Heroes\Updater\Updater;
use GW2Treasures\GW2Api\V2\Authentication\Exception\AuthenticationException;
use Illuminate\Mail\Message;
use Illuminate\Support\Collection;
use Mail;

class AccountUpdater extends Updater {
    use UpdatesCharacter;

    /**
     * @param AccountUpdatePayload $payload
     */
    protected function run($payload) {
        $api = $this->api();
        $account = $payload->account;

        // make sure the api key is valid
        if( !$account->api_key_valid ) {
            return;
        }

        try {
            /** @var Collection|Character[] $charactersLocal */
            $charactersLocal = $account->characters;

            // get all characters from api
            $charactersApi = $api->characters($account->api_key)->all();

            $characterMapping = $this->mapCharacters( $charactersLocal, $charactersApi );

            foreach( $characterMapping as $char ) {
                if( is_null( $char->api )) {
                    $this->deletedChar( $account, $char->local );
                } elseif( is_null( $char->local )) {
                    $this->createChar( $account, $char->api );
                } else {
                    $this->updateChar( $account, $char->local, $char->api );
                }
            }
        } catch( AuthenticationException $authException ) {
            $this->sendInvalidApiKeyMail($account);

            // mark the api key as invalid
            $account->api_key_valid = false;
            $account->save();
        }
    }

    /**
     * Maps local characters to the characters returned from the api.
     *
     * @param Character[] $charactersLocal
     * @param array[]     $charactersApi
     * @return array
     */
    protected function mapCharacters($charactersLocal, $charactersApi) {
        $mapping = [];

        // insert all characters from api into mapping array
        foreach( $charactersApi as $char ) {
            $mapping[] = (object)[
                'api' => $char,
                'local' => null
            ];
        }

        // map local characters to api
        foreach( $charactersLocal as $char ) {
            $apiChar = null;

            foreach( $mapping as $map ) {
                // check if this char was already mapped to a local char
                if( !is_null( $map->local )) {
                    continue;
                }

                // check if char is the same
                if( $char->created->eq(Carbon::createFromFormat( Carbon::ISO8601, $map->api->created )) &&
                    $char->race === $map->api->race &&
                    $char->profession === $map->api->profession &&
                    $char->level <= $map->api->level &&
                    $char->age <= $map->api->age &&
                    $char->deaths <= $map->api->deaths
                ) {
                    $map->local = $char;
                    $apiChar = $map->api;
                    continue;
                }
            }

            // if we haven't mapped this char, it was deleted
            if( is_null( $apiChar )) {
                $mapping[] = (object)[
                    'api' => null,
                    'local' => $char
                ];
            }
        }

        return $mapping;
    }

    /**
     * Mark local character as deleted.
     *
     * @param Account $account
     * @param Character $char
     */
    protected function deletedChar( Account $account, Character $char ) {
        // we don't do anything with this yet.
        echo 'processing '.$char->name.'...deleted'.PHP_EOL;
    }

    /**
     * Create a new local character based on the data returned from the api.
     *
     * @param Account $account
     * @param $char
     */
    protected function createChar( Account $account, $char ) {
        /** @var Character $character */
        $character = Character::createFromApiData($char, $account);
        Activity::characterCreated($character);

        $this->scheduleCharacterUpdate( new CharacterUpdatePayload($character) );
    }

    /**
     * Update the local character with the data returned from the api.
     *
     * @param Account $account
     * @param Character $localChar
     * @param $apiChar
     */
    protected function updateChar( Account $account, Character $localChar, $apiChar ) {
        // level
        if( $apiChar->level !== (int)$localChar->level ) {
            $localChar->level = $apiChar->level;

            Activity::characterLevel($localChar, $localChar->level);
        }

        // name
        if( $apiChar->name !== $localChar->name ) {
            $oldName = $localChar->name;
            $localChar->name = $apiChar->name;

            Activity::characterRenamed($localChar, $oldName, $apiChar->name);
        }

        // update all other changeable properties we don't fire activities for (yet)
        $localChar->gender = $apiChar->gender;
        $localChar->age = $apiChar->age;
        $localChar->deaths = $apiChar->deaths;

        $ageChanged = $localChar->getOriginal('age') !== $localChar->getAttribute('age');
        if( $ageChanged || $localChar->equipment()->count() === 0 || $this->probability(0.05) ) {
            $this->scheduleCharacterUpdate( new CharacterUpdatePayload($localChar) );
        }

        if( $localChar->isDirty() ) {
            $localChar->save();
        }
    }

    /**
     * Send a mail for invalid api keys
     * @param Account $account
     */
    protected function sendInvalidApiKeyMail(Account $account) {
        $subject = 'Invalid API key for your account ' . $account->name;
        Mail::send([
            'emails.invalid_api_key.html',
            'emails.invalid_api_key.text'
        ], compact('account', 'subject'), function (Message $mail) use ($account, $subject) {
            $mail->to($account->user->email, $account->user->name)
                ->subject($subject);
        });
    }
}
