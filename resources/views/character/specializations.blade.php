@extends('character.index')

@section('content.right')
    <h2>Specializations</h2>

    @forelse($specializations as $environment => $specs)
        <h3>{{ $environment }}</h3>

        @foreach($specs as $spec)
            <h4 class="spec__header">
                {{ $spec->specialization->getIcon() }} {{ $spec->specialization->name_en }}
            </h4>
            <div class="spec__traits" style="background-image: url({{ $spec->specialization->getBackgroundUrl() }})">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                     viewBox="0 0 100 100" preserveAspectRatio="none" class="spec__traits__selection">
                    <path d="M 08.333 50
                             L 25.000 {{ [12.5, 50, 87.5][$spec->traitIndexes['1-Major']] }}
                             L 41.666 50
                             L 58.333 {{ [12.5, 50, 87.5][$spec->traitIndexes['2-Major']] }}
                             L 75.000 50
                             L 91.666 {{ [12.5, 50, 87.5][$spec->traitIndexes['3-Major']] }}" />
                </svg>
                @foreach($spec->traits as $tier => $traitTier)
                    <div class="spec__traits__tier spec__traits__tier--{{ $tier }}">
                        @foreach($traitTier as $slot => $traitSlot)
                            <div class="spec__traits__{{ snake_case($slot) }}">
                                @foreach($traitSlot as $trait)
                                    <div class="spec__trait {{ !$trait->selected ? 'spec__trait--inactive' : '' }}">
                                        {{ $trait->trait->getIcon() }}
                                        <span class="spec__trait__tooltip">
                                            <span class="spec__trait__tooltip__name">{{ $trait->trait->name_en }}</span>
                                            <span class="spec__trait__tooltip__description">
                                                {{ $trait->trait->data_en->description }}
                                            </span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    @empty
        <p style="font-style: italic;">
            {{ $character->account->user->name }} doesn't share the specializations of {{ $character->name }}.
            @if( Auth::id() === $character->account->user->id )
                <br>
                <a href="{{ action('Settings\AccountsController@getEdit', [$character->account->id]) }}">
                    Edit your API key
                </a> to include the <span class="api-key__permission">build</span> permission.
            @endif
        </p>
    @endforelse
@stop
