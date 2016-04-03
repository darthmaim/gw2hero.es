@extends('support.index')

@section('title', 'About')

@section('content.right')
    <h2>About</h2>

    <a href="https://trello.com/b/lUJa4FuH/gw2heroes"
       title="Post suggestions on our Trello board">Trello</a> &bull;
    <a href="https://github.com/chillerlan/gw2hero.es"
       title="View and contribute to our source code on github">github</a> &bull;
    <a href="https://twitter.com/gw2heroes"
       title="Follow us on twitter">twitter</a> &bull;
    <a href="https://www.facebook.com/gw2heroes"
       title="Like us on facebook">facebook</a> &bull;
    <a href="{{ action('SupportController@getContact') }}"
       title="Contact us">Contact</a>
@stop
