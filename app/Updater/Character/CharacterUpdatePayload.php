<?php

namespace GW2Heroes\Updater\Character;

use GW2Heroes\Models\Character;
use GW2Heroes\Updater\UpdatePayload;

class CharacterUpdatePayload extends UpdatePayload {
    /** @var Character $character */
    public $character;

    public function __construct(Character $character) {
        $this->character = $character;
    }
}
