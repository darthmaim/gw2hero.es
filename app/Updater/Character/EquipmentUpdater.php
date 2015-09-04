<?php

namespace GW2Heroes\Updater\Character;

class EquipmentUpdater extends CharacterUpdater {
    /**
     * @param CharacterUpdatePayload $payload
     */
    protected function run($payload) {
        $character = $payload->character;
        $apiKey = $character->account->api_key;
        $api = $this->api();

        \Log::debug('Updating equipment of '. $character->name .' ['. $character->id.']');

        $equipment = $api->characters($apiKey)->equipment($character->name);
    }
}
