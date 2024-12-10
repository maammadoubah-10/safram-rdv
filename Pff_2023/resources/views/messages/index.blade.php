<!-- resources/views/messages/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Liste des conversations</h1>

    <ul>
        @foreach($conversations as $conversation)
            <li><a href="{{ route('messages.show', ['id' => $conversation->id]) }}">{{ $conversation->receiver->name }}</a></li>
        @endforeach
    </ul>

    <!-- Ajouter un lien pour envoyer un nouveau message -->
    <a href="{{ route('messages.create') }}">Nouveau Message</a>
@endsection
