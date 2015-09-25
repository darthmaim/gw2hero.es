<?php

namespace GW2Heroes\Updater\Specializations;

use GW2Heroes\Models\Specialization;
use GW2Heroes\Updater\Updater;
use Illuminate\Support\Collection;

class SpecializationUpdater extends Updater {
    use UpdatesSpecializations;

    protected function run($payload) {
        $specializationIdsToUpdate = $this->findNewSpecializationIDs();

        if( $specializationIdsToUpdate->count() < 200 ) {
            $additionalSpecializationIds = Specialization::random(200 - $specializationIdsToUpdate->count())->lists('id');
            $specializationIdsToUpdate = $specializationIdsToUpdate->merge( $additionalSpecializationIds );
        } else {
            $specializationIdsToUpdate = $specializationIdsToUpdate->slice(0, 200);
            $this->scheduleSpecializationsUpdate();
        }

        $this->updateSpecializations( $specializationIdsToUpdate->toArray() );
    }

    /**
     * @return Collection
     */
    protected function findNewSpecializationIDs() {
        /** @var Collection|Specialization[] $localSpecializations */
        $localSpecializations = Specialization::lists('id');
        $apiSpecializations = collect($this->api()->specializations()->ids());

        return $apiSpecializations->diff($localSpecializations);
    }

    /**
     * @param int[] $ids
     */
    protected function updateSpecializations( array $ids ) {
        $specializationEndpoint = $this->api()->specializations();

        $specialization_de = collect($specializationEndpoint->lang('de')->many($ids))->keyBy('id');
        $specialization_en = collect($specializationEndpoint->lang('en')->many($ids))->keyBy('id');
        $specialization_es = collect($specializationEndpoint->lang('es')->many($ids))->keyBy('id');
        $specialization_fr = collect($specializationEndpoint->lang('fr')->many($ids))->keyBy('id');


        foreach( $ids as $id ) {
            /** @var Specialization $specialization */
            $specialization = Specialization::findOrNew($id);

            $specialization->id = $id;

            $specialization->profession = $specialization_en[$id]->profession;
            $specialization->elite = $specialization_en[$id]->elite;

            $specialization->name_de = $specialization_de[$id]->name;
            $specialization->name_en = $specialization_en[$id]->name;
            $specialization->name_es = $specialization_es[$id]->name;
            $specialization->name_fr = $specialization_fr[$id]->name;
            $specialization->data_de = $specialization_de[$id];
            $specialization->data_en = $specialization_en[$id];
            $specialization->data_es = $specialization_es[$id];
            $specialization->data_fr = $specialization_fr[$id];

            $specialization->save();
        }
    }
}
