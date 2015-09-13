<?php

namespace GW2Heroes\Updater\Character;

use GW2Treasures\GW2Api\V2\Authentication\Exception\InvalidPermissionsException;

class EquipmentUpdater extends CharacterUpdater {
    /**
     * @param CharacterUpdatePayload $payload
     */
    protected function run($payload) {
        $character = $payload->character;
        $apiKey = $character->account->api_key;
        $api = $this->api();

        \Log::debug('Updating equipment of '. $character->name .' ['. $character->id.']');

        try {
            $equipment = $api->characters($apiKey)->equipment($character->name)->get();
            $character->equipment = $equipment;
        } catch( InvalidPermissionsException $exception ) {
            $character->equipment = false;
        }
        $character->save();
    }
}
