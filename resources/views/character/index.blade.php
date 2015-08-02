@extends('layout.wrapper')

@section('content.right')
    <h2>Summary</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non eros et metus laoreet volutpat id ut leo.
        Suspendisse elementum vestibulum faucibus. Nam accumsan mollis odio, sit amet maximus augue.
    </p>
    <p>
        Proin consectetur urna nibh, ut sodales est gravida vel. Donec dignissim sit amet orci vitae malesuada.
        Nulla facilisi. Nullam massa justo, tempus tempus enim at, ultrices vestibulum turpis. Donec tristique ultrices leo,
        id aliquam neque congue sit amet.
    </p>
@stop

@section('content.left')
    <div class="char-info-box">
        <h2 class="char-info-box__name">{{ $character->name }}</h2>
        <div class="char-info-box__char">
            <span class="level">{{ $character->level }}</span>
            <span class="race">{{ $character->race }}</span>
            <span class="profession">{{ $character->profession }}</span>
        </div>
        <div class="char-info-box__guild">
            Member of <a>Some Guild [some]</a>
        </div>
        <div class="char-info-box__owner">
            <a>{{ $character->account->user->name }}</a> &raquo; <a>{{ $character->account->getNameHtml() }}</a>
        </div>
    </div>

    <ul class="sidebar-nav">
        <li><a href="">Summary</a>
        <li><a href="">Story</a>
        <li><a href="">Activities</a>
        <li><a href="">Gallery</a>
        <li><a href="">Inventory</a>
        <li><a href="">Professions</a>
    </ul>
@stop
