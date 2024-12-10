<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;
use App\Models\Medecin; 
use App\Models\Specialite;
use App\Models\Rdv;
use App\Models\User;
use App\Models\DossiersMedicaux;
use App\Models\Patient;
use Illuminate\Http\Response;



use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image; // Assurez-vous d'importer la classe Image

class MedecinController extends Controller
{
    public function accueil()
    {
        if (Auth::check() && Auth::user()->isMedecin()) {
            $medecinId = Auth::user()->medecin->id;
            return view('medecin.accueil', compact('medecinId'));
        } else {
            return redirect()->route('home');
        }
    }

    public function edit($id)
    {
        $medecin = Medecin::find($id);
        $user = Auth::user(); // Récupérez l'utilisateur actuellement connecté

        return view('medecin.edit', [
            'medecin' => $medecin,
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
{
    // Validez les données du formulaire
    $validatedData = $request->validate([
        'name' => 'required',
        'lastName' => 'required',
        'adresse' => 'required',
        'tel' => 'required',
        'lieu' => 'required',
        'prixVisite' => 'required',
        'specialite' => 'required',
    ]);

    // Récupérez le médecin à partir de $id et mettez à jour ses informations
    $medecin = Medecin::find($id);
    $medecin->update($validatedData);

    // Redirigez l'utilisateur ou effectuez d'autres actions nécessaires
    return redirect()->route('medecin.compte.profil')->with('success', 'Profil du médecin mis à jour avec succès');
}

    
    public function create()
    {
        return view('disponibilite.create');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $disponibilite = Disponibilite::where('user_id', $user_id)->get();
        return view('medecin.disponibilite.list', compact('disponibilite'));
    }

    public function addDisponibilite()
    {
        // Récupérez les données de disponibilité depuis la base de données
        $disponibilite = Disponibilite::all();
        return view('medecin.disponibilite.add', compact('disponibilite'));
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $data = $request->validate([
            'date_disponibilite' => 'required|date',
            'heure_debut' => 'required',
            'heure_de_fin' => 'required',
        ]);

        $data['user_id'] = $userId;

        Disponibilite::create($data);

        return redirect()->route('medecin.disponibilite.add')->with('success', 'Disponibilité ajoutée avec succès.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/' . $filename;

            $img = Image::make($image);
            $img->resize(200, 200)->save(public_path($path));

            $medecin = Medecin::find(auth()->user()->id);
            $medecin->image = $path;
            $medecin->save();
        }

        return back()->with('success', 'Image téléchargée avec succès.');
    }

    public function profil(Request $request)
{
    $id = $request->user()->id; // Récupérer l'ID de l'utilisateur actuel

    $user = Auth::user();
    $medecin = $user->medecin;
    $specialite = $user->specialite;

    return view('medecin.compte.profil', [
        'user' => $user,
        'medecin' => $medecin,
        'specialite' => $specialite,
    ]);
}


    public function mesRendezVous(Request $request)
    {
        $medecinId = $request->query('medecinId');
        $mesRendezVous = Rdv::where('medecin_id', $medecinId)->get();
    
        return view('medecin.mes_rendezvous', ['mesRendezVous' => $mesRendezVous]);
    }
    
    
    

    public function dossierpatient()
{
    // Récupérez l'utilisateur connecté (médecin)
    $medecin = Auth::user();

    // Récupérez les rendez-vous du médecin avec les informations des patients
    $rdvs = $medecin->rdvs()->with('user')->get();

    // Regroupez les rendez-vous par l'ID du patient
    $rdvsGrouped = $rdvs->groupBy('user.id');

    return view('medecin.dossiers-patients', ['rdvsGrouped' => $rdvsGrouped]);
}

    






    public function viewDossierMedical(User $user)
{
    $medecin = Auth::user();

    // Récupérez le dossier médical du patient lié au médecin
    $dossierMedical = DossiersMedicaux::where('user_id', $user->id)
        ->where('medecin_id', $medecin->id)
        ->first();

    if (!$dossierMedical) {
        return redirect()->route('medecin.dossier-medical', ['patientId' => $user->id])->with('error', 'Dossier médical non trouvé pour ce patient.');
    }

    return view('medecin.dossier-medical', [
        'dossierMedical' => $dossierMedical,
        'patient' => $user, // Passez le nom du patient à la vue
    ]);
}

    

    public function createDossierMedical(Request $request, $patientId)
    {
        // Vérifier si le dossier médical existe déjà pour le patient
        $existingDossierMedical = DossiersMedicaux::where('user_id', $patientId)->first();

        if ($existingDossierMedical) {
            // Un dossier médical existe déjà pour ce patient
            return redirect()->route('medecin.dossiers-patients')->with('error', 'Un dossier médical existe déjà pour ce patient.');
        }

        // Si la requête est de type POST, cela signifie que le formulaire a été soumis
        if ($request->isMethod('post')) {
            // Valider les données du formulaire (ajoutez les règles de validation en fonction de vos besoins)
            $request->validate([
                'antecedents_medicaux' => 'nullable|string',
                'allergies' => 'nullable|string',
                'informations_medicales' => 'nullable|string',
                'notes_consultation' => 'nullable|string',
                'ordonnance' => 'nullable|string',
            ]);

            // Créer un nouveau dossier médical
            $dossierMedical = new DossiersMedicaux();
            $dossierMedical->user_id = $patientId; // ID du patient
            $dossierMedical->medecin_id = auth()->user()->id; // ID du médecin
            $dossierMedical->antecedents_medicaux = $request->input('antecedents_medicaux');
            $dossierMedical->allergies = $request->input('allergies');
            $dossierMedical->informations_medicales = $request->input('informations_medicales');
            $dossierMedical->notes_consultation = $request->input('notes_consultation');
            $dossierMedical->ordonnance = $request->input('ordonnance');

            // Sauvegarder le dossier médical
            $dossierMedical->save();

            // Rediriger avec un message de succès (ajoutez un message personnalisé si nécessaire)
            return redirect()->route('medecin.dossiers-patients', ['patientId' => $patientId])->with('success', 'Dossier médical créé avec succès.');
        } else {
            // Afficher la page de création de dossiers médicaux
            return view('medecin.createDossierMedical', ['patientId' => $patientId]);
        }
    }

    public function editDossierMedical($patientId)
    {
        // Récupérer le patient en utilisant $patientId
        $patient = User::find($patientId);

        if (!$patient) {
            // Gérer le cas où le patient n'est pas trouvé
            abort(404, 'Patient non trouvé');
        }

        // Récupérer le dossier médical du patient
        $dossierMedical = DossiersMedicaux::where('user_id', $patient->id)->first();

        // Si le dossier médical n'existe pas, vous pourriez créer un nouveau dossier médical ici

        return view('medecin.edit-dossier-medical', ['patient' => $patient,'dossierMedical' => $dossierMedical,]);
    }

    public function updateDossierMedical(Request $request, $patientId)
    {
        // Validez les données du formulaire selon vos besoins

        // Récupérer le patient
        $patient = User::find($patientId);

        if (!$patient) {
            // Gérer le cas où le patient n'est pas trouvé
            abort(404, 'Patient non trouvé');
        }

        // Récupérer le dossier médical du patient
        $dossierMedical = DossiersMedicaux::where('user_id', $patient->id)->first();

        if (!$dossierMedical) {
            // Gérer le cas où le dossier médical n'est pas trouvé
            abort(404, 'Dossier médical non trouvé');
        }

        // Mettez à jour les informations du dossier médical
        $dossierMedical->update([
            'antecedents_medicaux' => $request->input('antecedents_medicaux'),
            'allergies' => $request->input('allergies'),
            // Mettez à jour d'autres champs du dossier médical
        ]);

        // Rediriger avec un message de succès ou afficher la vue de confirmation

        // Exemple de redirection vers la liste des dossiers patients
        return redirect()->route('medecin.dossiers-patients')->with('success', 'Dossier médical mis à jour avec succès');
    }




public function editDisponibilite($id)
{
    // Récupérez la disponibilité à éditer
    $disponibilite = Disponibilite::find($id);

    if (!$disponibilite) {
        return redirect()->route('medecin.disponibilite.list')->with('error', 'Disponibilité non trouvée.');
    }

    return view('medecin.disponibilite.edit', compact('disponibilite'));
}


public function updateDisponibilite(Request $request, $id)
{
    // Validez les données du formulaire
    $data = $request->validate([
        'date_disponibilite' => 'required|date',
        'heure_debut' => 'required',
        'heure_de_fin' => 'required',
    ]);

    // Trouvez l'enregistrement de disponibilité à mettre à jour
    $disponibilite = Disponibilite::find($id);

    // Mettez à jour les champs de l'enregistrement
    $disponibilite->date_disponibilite = $data['date_disponibilite'];
    $disponibilite->heure_debut = $data['heure_debut'];
    $disponibilite->heure_fin = $data['heure_de_fin'];

    // Sauvegardez les modifications
    $disponibilite->save();

    return redirect()->route('medecin.disponibilite.list')->with('success', 'Disponibilité mise à jour avec succès.');
}

// Ajoutez cette méthode dans votre contrôleur MedecinController
public function deleteDisponibilite($id)
{
    // Récupérez la disponibilité à supprimer
    $disponibilite = Disponibilite::find($id);

    if (!$disponibilite) {
        return redirect()->route('disponibilite.index')->with('error', 'Disponibilité non trouvée.');
    }

    // Supprimez la disponibilité
    $disponibilite->delete();

    return redirect()->route('disponibilite.index')->with('success', 'Disponibilité supprimée avec succès.');
}




public function rendezVousAVenir()
{
    // Récupérez l'ID du médecin connecté
    $medecinId = auth()->user()->medecin->id;

    // Récupérez les rendez-vous confirmés avec ce médecin
    $rendezVousAVenir = Rdv::where('medecin_id', $medecinId)
        ->where('statut', 'confirmé')
        ->where('date', '>=', now()) // Pour obtenir les rendez-vous à venir
        ->orderBy('date', 'asc')
        ->orderBy('heure_debut', 'asc')
        ->get();

    return view('medecin.rendezvous-avenir', compact('rendezVousAVenir'));
}





}
