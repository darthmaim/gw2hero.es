<?php

namespace GW2Heroes\Updater\Items;

use GW2Heroes\Updater\SchedulesUpdate;

trait UpdatesItems {
    use SchedulesUpdate;

    public function scheduleItemsUpdate() {
        $this->scheduleUpdate(ItemUpdater::class, null);
    }
}
