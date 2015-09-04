<?php

namespace GW2Heroes\Updater\Character;

use GW2Heroes\Updater\Updater;

class CharacterUpdater extends Updater {
    use UpdatesCharacter;

    /**
     * @param CharacterUpdatePayload $payload
     */
    protected function run($payload) {
        \Log::debug('Updating character '.$payload->character->name.' ['.$payload->character->id.']');

        $this->scheduleCharacterEquipmentUpdate($payload);
    }
}
