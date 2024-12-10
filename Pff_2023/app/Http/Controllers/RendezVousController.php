<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rdv;
use App\Models\Medecin;
use App\Models\Disponibilite;
use Auth;

class RendezVousController extends Controller
{
    public function afficherDisponibilites($medecinId)
    {
        // Récupérez le médecin depuis la base de données
        $medecin = Medecin::find($medecinId);
    
        if (!$medecin) {
            // Gérez le cas où le médecin n'a pas été trouvé
            return redirect()->back()->with('error', 'Médecin non trouvé.');
        }
    
        // Récupérez les disponibilités du médecin
        $disponibilites = Disponibilite::where('user_id', $medecin->user_id)->get();
    
        return view('patient.disponibilites', [
            'medecin' => $medecin,
            'disponibilites' => $disponibilites,
        ]);
    }

    public function afficherFormulaire($medecinId, $disponibiliteId)
    {
        // Récupérez le médecin depuis la base de données
        $medecin = Medecin::find($medecinId);
    
        if (!$medecin) {
            return redirect()->back()->with('error', 'Médecin non trouvé.');
        }
    
        // Récupérez la disponibilité sélectionnée
        $disponibilite = Disponibilite::find($disponibiliteId);
    
        if (!$disponibilite) {
            return redirect()->back()->with('error', 'Disponibilité non trouvée.');
        }
    
        // Vérifiez si un rendez-vous existe pour cette disponibilité
        $rendezVousExistant = Rdv::where('disponibilite_id', $disponibiliteId)->first();
    
        if ($rendezVousExistant) {
            return redirect()->back()->with('error', 'Désolé, cette disponibilité est déjà prise par un autre patient.');
        }
    
        // Si la disponibilité est disponible, affichez la page du formulaire
        return view('patient.rdv.description', [
            'medecin' => $medecin,
            'disponibilite' => $disponibilite,
            'disponibilite_id' => $disponibiliteId,
        ]);
    }
    


public function enregistrer(Request $request, $medecinId, $disponibiliteId)
{
    $user = Auth::user();
    $description = $request->input('description');

    // Assurez-vous de valider les données du formulaire ici, par exemple la description du rendez-vous.

    
    // Récupérez la date, l'heure de début et l'heure de fin à partir de la disponibilité
    $disponibilite = Disponibilite::find($disponibiliteId);
    

    if (!$disponibilite) {
        return redirect()->back()->with('error', 'Disponibilité non trouvée.');
    }

    // Check if the user is authenticated
    if (!$user) {
        return redirect()->back()->with('error', 'Utilisateur non authentifié.');
    }

    $date = $disponibilite->date_disponibilite;
    $heureDebut = $disponibilite->heure_debut;
    $heureFin = $disponibilite->heure_de_fin;

    // Récupérez la description du formulaire
    $description = $request->input('description'); // Assurez-vous d'ajouter un champ 'description' dans votre formulaire

    Rdv::create([
        'user_id' => $user->id,
        'medecin_id' => $medecinId,
        'disponibilite_id' => $disponibiliteId,
        'date' => $date,
        'heure_debut' => $heureDebut,
        'heure_fin' => $heureFin,
        'description' => $description,
        'statut' => 'en attente',
    ]);

    return redirect()->route('patient.rdv.confirmation')->with('success', 'Rendez-vous enregistré avec succès!');
}


    public function confirmation(Request $request)
    {
        $medecinId = $request->input('medecin_id');
        $disponibiliteId = $request->input('disponibilite_id');
        
        // Récupérez le médecin et la disponibilité en fonction des IDs
        $medecin = Medecin::find($medecinId);
        $disponibilite = Disponibilite::find($disponibiliteId);

        // Assurez-vous que les modèles $medecin et $disponibilite existent avant de continuer

        return view('patient.rdv.confirmation', compact('medecin', 'disponibilite'));
    }

    public function confirm($id)
    {
        // Récupérez le rendez-vous en fonction de l'ID
        $rdv = Rdv::findOrFail($id);

        // Mettez à jour l'état du rendez-vous
        $rdv->update(['statut' => 'confirmé']);

        return redirect()->back()->with('confirmé');
    }

    public function reject($id)
    {
        // Récupérez le rendez-vous en fonction de l'ID
        $rdv = Rdv::findOrFail($id);

        // Mettez à jour l'état du rendez-vous
        $rdv->update(['statut' => 'refusé']);

        return redirect()->back()->with('Refusé');
    }

    public function afficherRdvAcceptes()
    {

    $patientId = Auth::user()->id; // Récupérez l'ID du patient connecté
    $rendezVousAcceptes = Rdv::where('user_id', $patientId)->where('statut', 'confirmé')->get();
    $rendezVousRefuses = Rdv::where('user_id', $patientId)->where('statut', 'refusé')->get();
    $rendezVousEnAttente = Rdv::where('user_id', $patientId)->where('statut', 'en attente')->get();

    return view('patient.rdv.rdv_accepter', ['rendezVousAcceptes' => $rendezVousAcceptes,]);

    }

    public function afficherRdvRefuser()
    {

        $patientId = Auth::user()->id; // Récupérez l'ID du patient connecté
        $rendezVousAcceptes = Rdv::where('user_id', $patientId)->where('statut', 'confirmé')->get();
        $rendezVousRefuses = Rdv::where('user_id', $patientId)->where('statut', 'refusé')->get();
        $rendezVousEnAttente = Rdv::where('user_id', $patientId)->where('statut', 'en attente')->get();
    
        return view('patient.rdv.rdv_refuser', ['rendezVousRefuses' => $rendezVousRefuses,]);
     
    } 

    public function afficherRdvAttente()
{
    $patientId = Auth::user()->id; // Récupérez l'ID du patient connecté
    $rendezVousAcceptes = Rdv::where('user_id', $patientId)->where('statut', 'confirmé')->get();
    $rendezVousRefuses = Rdv::where('user_id', $patientId)->where('statut', 'refusé')->get();
    $rendezVousEnAttente = Rdv::where('user_id', $patientId)->where('statut', 'en attente')->get();

    return view('patient.rdv.rdv_en_attente', ['rendezVousEnAttente' => $rendezVousEnAttente,]);
}
    




public function showStatistics()
{
    $year = date('Y'); // Récupérez l'année en cours
    $confirmed = Rdv::where('statut', 'confirmé')->whereYear('date', $year)->count();
    $refused = Rdv::where('statut', 'refusé')->whereYear('date', $year)->count();
    $waiting = Rdv::where('statut', 'en attente')->whereYear('date', $year)->count();

    $data = [
        'confirmé' => $confirmed,
        'refusés' => $refused,
        'en_attente' => $waiting,
    ];

    return view('admin.statistiques.statistics', compact('data'));
}





}
