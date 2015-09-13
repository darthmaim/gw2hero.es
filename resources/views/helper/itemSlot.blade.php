<div class="itemSlot">
    @if(!is_null($item))
        <a href="https://gw2treasures.com/item/{{ $item->id }}">{{ $item->id }}</a>
        @if(isset($item->upgrades))
            upgraded with {{ implode(', ', $item->upgrades) }}
        @endif
    @else
        <i>Empty</i>
    @endif
</div>
