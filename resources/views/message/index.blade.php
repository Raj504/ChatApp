@extends('layouts.app')

@section('content')


<div id="app">
    <chat-component :user="{{ auth()->user() }}" :chat-groups="{{ $chatGroups }}"></chat-component>
</div>
@endsection



