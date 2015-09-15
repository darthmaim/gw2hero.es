<div class="itemSlot">
    @if(!is_null($item))
        @if(!is_null($item->item))
            <a href="https://gw2treasures.com/item/{{ $item->item_id }}">
                {{ $item->item->getIcon(32) }}{{ $item->item->name_en }}</a>
        @else
            <a class="itemSlot__empty"
               href="https://gw2treasures.com/item/{{ $item->item_id }}">[{{ $item->item_id }}]</a>
        @endif
        @if(isset($item->data->upgrades))
            @foreach($item->data->upgrades as $upgrade_id)
                <?php $upgrade = \GW2Heroes\Models\Item::find($upgrade_id); ?>
                <div class="itemSlot__upgrade">
                    @if( !is_null( $upgrade ))
                        <a href="https://gw2treasures.com/item/{{ $upgrade_id }}">
                            {{ $upgrade->getIcon(24) }}{{ $upgrade->name_en }}</a>
                    @else
                        <a class="itemSlot__empty"
                           href="https://gw2treasures.com/item/{{ $upgrade_id }}">[{{ $upgrade_id}}]</a>
                    @endif
                </div>
            @endforeach
        @endif
    @else
        <i class="itemSlot__empty">Empty</i>
    @endif
</div>
