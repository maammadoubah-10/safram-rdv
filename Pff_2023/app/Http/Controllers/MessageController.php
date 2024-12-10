<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
class MessageController extends Controller
{
    
    public function index()
{
    // Logique pour récupérer la liste des conversations
    $conversations = Message::all(); // Ou utilisez votre logique de récupération des conversations

    return view('messages.index', ['conversations' => $conversations]);
}


public function show($id)
{
    // Assure you are eager loading the necessary relationships
    $conversation = Message::with(['sender', 'receiver', 'conversation'])->find($id);

    // Check if the conversation exists
    if (!$conversation) {
        abort(404); // or handle as appropriate
    }

    // Pass the conversation to the view
    return view('messages.show', compact('conversation'));
}




    public function store(Request $request)
    {
        // Validez les données du formulaire
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required',
        ]);

        // Créez un nouveau message
        $message = new Message;
        $message->sender_id = auth()->id();
        $message->receiver_id = $request->input('receiver_id');
        $message->message = $request->input('message');
        $message->save();

        // Redirigez avec un message flash ou affichez la vue appropriée
        return redirect()->route('messages.show', ['id' => $request->input('receiver_id')])->with('success', 'Message envoyé avec succès!');
    }

    public function create()
    {
        // Exemple : Charger des données depuis la base de données
        $users = User::all();

        // Renvoyer la vue avec les données nécessaires
        return view('messages.create', ['users' => $users]);
    }

}
