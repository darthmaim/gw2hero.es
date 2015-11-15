<?php

namespace GW2Heroes\Updater\Items;

use GW2Heroes\Models\Item;
use GW2Heroes\Updater\Updater;
use Illuminate\Support\Collection;

class ItemUpdater extends Updater {
    use UpdatesItems;

    protected function run($payload) {
        $itemIdsToUpdate = $this->findNewItemIDs();

        if( $itemIdsToUpdate->count() < 200 ) {
            $additionalItemIds = Item::random(200 - $itemIdsToUpdate->count())->lists('id');
            $itemIdsToUpdate = $itemIdsToUpdate->merge( $additionalItemIds );
        } else {
            $itemIdsToUpdate = $itemIdsToUpdate->slice(0, 200);
            $this->scheduleItemsUpdate();
        }

        $this->updateItems( $itemIdsToUpdate->toArray() );
    }

    /**
     * @return Collection
     */
    protected function findNewItemIDs() {
        /** @var Collection|Item[] $localItems */
        $localItems = Item::lists('id');
        $apiItems = collect($this->api()->items()->ids());

        return $apiItems->diff($localItems);
    }

    /**
     * @param int[] $ids
     */
    protected function updateItems( array $ids ) {
        $itemEndpoint = $this->api()->items();

        $items_de = collect($itemEndpoint->lang('de')->many($ids))->keyBy('id');
        $items_en = collect($itemEndpoint->lang('en')->many($ids))->keyBy('id');
        $items_es = collect($itemEndpoint->lang('es')->many($ids))->keyBy('id');
        $items_fr = collect($itemEndpoint->lang('fr')->many($ids))->keyBy('id');


        foreach( $ids as $id ) {
            $item = Item::findOrNew($id);

            $item->id = $id;
            $item->name_de = isset($items_de[$id]->name) ? $items_de[$id]->name : '';
            $item->name_en = isset($items_en[$id]->name) ? $items_en[$id]->name : '';
            $item->name_es = isset($items_es[$id]->name) ? $items_es[$id]->name : '';
            $item->name_fr = isset($items_fr[$id]->name) ? $items_fr[$id]->name : '';
            $item->data_de = $items_de[$id];
            $item->data_en = $items_en[$id];
            $item->data_es = $items_es[$id];
            $item->data_fr = $items_fr[$id];

            $item->save();
        }
    }
}
