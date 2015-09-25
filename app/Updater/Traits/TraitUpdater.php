<?php

namespace GW2Heroes\Updater\Traits;

use GW2Heroes\Models\Traits;
use GW2Heroes\Updater\Updater;
use Illuminate\Support\Collection;

class TraitUpdater extends Updater {
    use UpdatesTraits;

    protected function run($payload) {
        $traitIdsToUpdate = $this->findNewTraitIDs();

        if( $traitIdsToUpdate->count() < 200 ) {
            $additionalTraitIds = Traits::random(200 - $traitIdsToUpdate->count())->lists('id');
            $traitIdsToUpdate = $traitIdsToUpdate->merge( $additionalTraitIds );
        } else {
            $traitIdsToUpdate = $traitIdsToUpdate->slice(0, 200);
            $this->scheduleTraitsUpdate();
        }

        $this->updateTraits( $traitIdsToUpdate->toArray() );
    }

    /**
     * @return Collection
     */
    protected function findNewTraitIDs() {
        /** @var Collection|Trait[] $localTraits */
        $localTraits = Traits::lists('id');
        $apiTraits = collect($this->api()->traits()->ids());

        return $apiTraits->diff($localTraits);
    }

    /**
     * @param int[] $ids
     */
    protected function updateTraits( array $ids ) {
        $traitEndpoint = $this->api()->traits();

        $traits_de = collect($traitEndpoint->lang('de')->many($ids))->keyBy('id');
        $traits_en = collect($traitEndpoint->lang('en')->many($ids))->keyBy('id');
        $traits_es = collect($traitEndpoint->lang('es')->many($ids))->keyBy('id');
        $traits_fr = collect($traitEndpoint->lang('fr')->many($ids))->keyBy('id');


        foreach( $ids as $id ) {
            /** @var Traits $trait */
            $trait = Traits::findOrNew($id);

            $trait->id = $id;

            $trait->specialization_id = $traits_en[$id]->specialization;
            $trait->tier = $traits_en[$id]->tier;
            $trait->slot = $traits_en[$id]->slot;

            $trait->name_de = $traits_de[$id]->name;
            $trait->name_en = $traits_en[$id]->name;
            $trait->name_es = $traits_es[$id]->name;
            $trait->name_fr = $traits_fr[$id]->name;
            $trait->data_de = $traits_de[$id];
            $trait->data_en = $traits_en[$id];
            $trait->data_es = $traits_es[$id];
            $trait->data_fr = $traits_fr[$id];

            $trait->save();
        }
    }
}
