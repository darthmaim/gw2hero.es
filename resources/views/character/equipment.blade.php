@extends('character.index')

@section('content.right')
    <h2>Equipment</h2>

    @if($equipment->count() === 0)
        <p style="font-style: italic;">
            The equipment of {{ $character->name }} hasn't been loaded yet.
        </p>
    @else
        <h3>Weapons</h3>
        <h4>First weaponset</h4>
        @include('helper.itemSlot', ['item' => $equipment->get('WeaponA1')])
        @include('helper.itemSlot', ['item' => $equipment->get('WeaponA2')])

        <h4>Second weaponset</h4>
        @include('helper.itemSlot', ['item' => $equipment->get('WeaponB1')])
        @include('helper.itemSlot', ['item' => $equipment->get('WeaponB2')])

        <h4>Aquatic</h4>
        @include('helper.itemSlot', ['item' => $equipment->get('WeaponAquaticA')])
        @include('helper.itemSlot', ['item' => $equipment->get('WeaponAquaticB')])

        <h3>Armor</h3>
        @include('helper.itemSlot', ['item' => $equipment->get('Helm')])
        @include('helper.itemSlot', ['item' => $equipment->get('Shoulders')])
        @include('helper.itemSlot', ['item' => $equipment->get('Coat')])
        @include('helper.itemSlot', ['item' => $equipment->get('Gloves')])
        @include('helper.itemSlot', ['item' => $equipment->get('Leggings')])
        @include('helper.itemSlot', ['item' => $equipment->get('Boots')])
        @include('helper.itemSlot', ['item' => $equipment->get('HelmAquatic')])

        <h3>Trinkets</h3>
        @include('helper.itemSlot', ['item' => $equipment->get('Amulet')])
        @include('helper.itemSlot', ['item' => $equipment->get('Ring1')])
        @include('helper.itemSlot', ['item' => $equipment->get('Ring2')])
        @include('helper.itemSlot', ['item' => $equipment->get('Accessory1')])
        @include('helper.itemSlot', ['item' => $equipment->get('Accessory2')])

        <h3>Tools</h3>
        @include('helper.itemSlot', ['item' => $equipment->get('Pick')])
        @include('helper.itemSlot', ['item' => $equipment->get('Axe')])
        @include('helper.itemSlot', ['item' => $equipment->get('Sickle')])
    @endif
@stop
