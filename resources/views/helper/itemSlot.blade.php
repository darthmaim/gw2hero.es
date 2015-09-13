<div class="itemSlot">
    @if(!is_null($item))
        @if(!is_null($item->item))
            <a href="https://gw2treasures.com/item/{{ $item->item_id }}">
                {{ $item->item->getIcon(32) }} {{ $item->item->name_en }}</a>
        @else
            <a href="https://gw2treasures.com/item/{{ $item->item_id }}">{{ $item->item_id }}</a>
        @endif
        @if(isset($item->data->upgrades))
            upgraded with {{ implode(', ', $item->data->upgrades) }}
        @endif
    @else
        <i>Empty</i>
    @endif
</div>
