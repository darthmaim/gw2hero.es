<?php

namespace GW2Heroes\Updater\Character;

use GW2Heroes\Updater\SchedulesUpdate;

trait UpdatesCharacter {
    use SchedulesUpdate;

    public function scheduleCharacterUpdate(CharacterUpdatePayload $payload) {
        $this->scheduleUpdate(CharacterUpdater::class, $payload);
    }

    public function scheduleCharacterEquipmentUpdate(CharacterUpdatePayload $payload) {
        $this->scheduleUpdate(EquipmentUpdater::class, $payload);
    }
}
