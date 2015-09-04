<?php

namespace GW2Heroes\Updater;

use GW2Treasures\GW2Api\GW2Api;
use Queue;

class Updater {
    use SchedulesUpdate;

    private $scheduledUpdates = [];

    public function scheduleUpdate($updater, UpdatePayload $payload) {
        if( !array_key_exists( $updater, $this->scheduledUpdates )) {
            $this->scheduledUpdates[$updater] = [];
        }

        $this->scheduledUpdates[$updater][] = $payload;
    }

    public function runScheduledUpdates() {
        foreach($this->scheduledUpdates as $updaterType => $updaterPayloads) {
            /** @var Updater $updater */
            $updater = new $updaterType();

            foreach( $updaterPayloads as $payload ) {
                $updater->run($payload);
            }

            $updater->queueScheduledUpdates();
        }
    }

    /**
     * Adds all scheduled updates to the queue.
     */
    public function queueScheduledUpdates() {
        if( !empty($this->scheduledUpdates) ) {
            Queue::push(Updater::class, array_map('serialize', $this->scheduledUpdates));
        }
    }

    public function fire($_, $data) {
        $this->scheduledUpdates = array_map('unserialize', $data);
        $this->runScheduledUpdates();
    }

    protected function run($payload) {}

    /**
     * @return GW2Api
     */
    protected function api() {
        return app('gw2api');
    }

    protected function probability($probability = 0.5) {
        $random = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
        return $random <= $probability;
    }
}
