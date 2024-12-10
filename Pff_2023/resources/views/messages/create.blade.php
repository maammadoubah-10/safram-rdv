<!-- resources/views/messages/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Nouveau Message</h1>

    <form method="post" action="{{ route('messages.store') }}">
        @csrf

        <!-- Champs du formulaire (par exemple, receiver_id, message) -->

        <label for="receiver_id">Destinataire:</label>
        <input type="text" name="receiver_id" value="{{ old('receiver_id') }}" required>

        <label for="message">Message:</label>
        <textarea name="message" rows="3" required>{{ old('message') }}</textarea>

        <button type="submit">Envoyer</button>
    </form>
@endsection
