<?php

namespace GW2Heroes\Updater\Character;

use GW2Heroes\Models\Equipment;
use GW2Treasures\GW2Api\V2\Authentication\Exception\InvalidPermissionsException;
use Illuminate\Support\Collection;

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
            $apiEquipment = collect($api->characters($apiKey)->equipment($character->name)->get())->keyBy('slot');

            // get current equipment
            /** @var Collection|Equipment[] $localEquipment */
            $localEquipment = $character->equipment->keyBy('slot');

            // update local equipment
            foreach( $apiEquipment as $equipment ) {
                /** @var Equipment $equipmentModel */
                $equipmentModel = $localEquipment->get( $equipment->slot, new Equipment() );

                $equipmentModel->slot = $equipment->slot;
                $equipmentModel->item_id = $equipment->id;
                $equipmentModel->data = $equipment;

                $character->equipment()->save($equipmentModel);
            }

            // delete all local records that aren't included in the api anymore
            foreach( $localEquipment as $equipment ) {
                if( !$apiEquipment->has($equipment->slot) ) {
                    $equipment->delete();
                }
            }

        } catch( InvalidPermissionsException $exception ) {
            //
        }
        $character->save();
    }
}
