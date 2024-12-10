<!-- resources/views/messages/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Conversation avec {{ $conversation->receiver->name }}</h1>

    <ul>
        @foreach($conversation->messages as $message)
            <li>
                <strong>{{ $message->sender->name }}:</strong>
                {{ $message->message }}
            </li>
        @endforeach
    </ul>

    <!-- Formulaire pour envoyer de nouveaux messages -->
    <form method="post" action="{{ route('messages.store') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $conversation->receiver->id }}">
        <textarea name="message" rows="3" placeholder="Écrivez votre message"></textarea>
        <button type="submit">Envoyer</button>
    </form>
@endsection
