<?php

namespace App\Http\Controllers;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Rdv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientController extends Controller
{
    public function accueilPatient()
    {
        return view('patient.accueilPatient');
    }

    public function accueil()
    {
        return view('patient.rdv.accueil');
    }


    public function rechercheMedecin(Request $request)
    {
        // Récupérez la spécialité recherchée depuis la requête
        $specialiteRecherchee = $request->input('specialite');

        // Recherchez les médecins ayant cette spécialité avec les attributs supplémentaires
        $medecins = Medecin::whereHas('specialite', function ($query) use ($specialiteRecherchee) {
            $query->where('nom', $specialiteRecherchee);
        })->get(['id', 'name', 'lastName', 'adresse', 'tel', 'lieu', 'prixVisite']);
        

        return view('patient.resultats', compact('medecins', 'specialiteRecherchee'));
    }

    
    public function profil()
    {
        // Récupérez l'utilisateur actuel
        $user = Auth::user();

        // Vérifiez si l'utilisateur a des informations
        $userHasInfo = Patient::where('user_id', $user->id)->exists();

        // Retournez la vue avec les données
        return view('patient.compte.profil', compact('userHasInfo'));
    }








    public function storeInfo(Request $request)
    {
        // Assurez-vous que l'utilisateur est connecté
        if (auth()->check()) {
            $user = auth()->user();
            
            // Validez les données du formulaire
            $this->validate($request, [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'date_de_naissance' => 'required|date',
                'sexe' => 'required|in:Homme,Femme',
                'adresse' => 'required|string',
                'numero_telephone' => 'required|string',
                'contacts_urgence' => 'required|string',
            ]);
            
            // Créez une instance de Patient avec les données du formulaire
            $patient = new Patient([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'date_de_naissance' => $request->input('date_de_naissance'),
                'sexe' => $request->input('sexe'),
                'adresse' => $request->input('adresse'),
                'numero_telephone' => $request->input('numero_telephone'),
                'contacts_urgence' => $request->input('contacts_urgence'),
                'user_id' => $user->id,
            ]);

            // Enregistrez le patient
            $patient->save();

            return redirect()->route('patient.compte.profil')->with('success', 'Informations enregistrées avec succès');
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour effectuer cette action.');
        }
    }

    public function showInfo()
    {
        $user = auth()->user(); // Récupérez l'utilisateur connecté

        if ($user) {
            $patient = Patient::where('user_id', $user->id)->first(); // Recherchez le patient par user_id

            return view('patient.compte.info', compact('user', 'patient'));
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }
    }

    public function editInfo()
    {
        $user = auth()->user(); // Récupérez l'utilisateur connecté

        if ($user) {
            $patient = Patient::where('user_id', $user->id)->first(); // Recherchez le patient par user_id

            return view('patient.compte.edit', compact('user', 'patient'));
        } else {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }
    }

    public function listeDossiersMedicaux()
    {
        // Récupérez l'utilisateur connecté (patient)
        $patient = Auth::user();
    
        // Récupérez les dossiers médicaux associés au patient
        $dossiersMedicaux = $patient->dossiersMedicaux;
    
        return view('patient.liste-dossiers-medicaux', ['dossiersMedicaux' => $dossiersMedicaux]);
    }

    public function voirDossierMedical($dossierId)
    {
        // Récupérez le dossier médical spécifié
        $dossierMedical = DossiersMedicaux::findOrFail($dossierId);

        // Ajoutez d'autres logiques selon vos besoins

        return view('patient.voir-dossier-medical', ['DossiersMedicaux' => $dossierMedical]);
    }


    public function updateInfo(Request $request)
    {
        $user = auth()->user(); // Récupérez l'utilisateur connecté

        $patient = Patient::where('user_id', $user->id)->first(); // Recherchez le patient par user_id

        // Mettez à jour les champs du patient avec les nouvelles valeurs du formulaire
        $patient->nom = $request->input('nom');
        $patient->prenom = $request->input('prenom');
        // Ajoutez d'autres champs de formulaire ici

        $patient->save(); // Enregistrez les modifications

        return redirect()->route('patient.info')->with('success', 'Informations mises à jour avec succès');
    }

    public function recherche()
    {
        return view('patient.rdv.recherche');
    }
    
    public function resultats(Request $request)
    {
        $search = $request->input('search');

        $medecins = Medecin::where('name', 'LIKE', "%$search%")
            ->orWhere('lastName', 'LIKE', "%$search%")
            ->get();

        return view('patient.rdv.resultats', ['medecins' => $medecins]);
    }

    public function listeMedecins()
    {
        $medecins = Medecin::paginate(8);
      
        return view('patient.liste_medecins', compact('medecins'));
    }

    public function detailsMedecin($id)
    {
        $medecin = Medecin::find($id);
        return view('medecin.rendez-vous-avenir', compact('medecin'));
        
    }

    public function prendreRvd()
    {
        return view('patient.prendreRdv');
    }

    public function rechercherMedecin(Request $request)
{
    $search = $request->input('search');

    $medecins = Medecin::where('name', 'LIKE', "%$search%")
        ->orWhere('lastName', 'LIKE', "%$search%")
        ->get();

    return view('patient.rdv.resultats', ['medecins' => $medecins]);
}


public function historiqueRendezVous()
{
    $patientId = Auth::user()->id; // Récupérez l'ID du patient connecté
    $rendezVousAcceptes = Rdv::where('user_id', $patientId)->where('statut', 'confirmé')->get();
    $rendezVousRefuses = Rdv::where('user_id', $patientId)->where('statut', 'refusé')->get();
    $rendezVousEnAttente = Rdv::where('user_id', $patientId)->where('statut', 'en attente')->get();

    return view('patient.historique-rendezvous', [
        'rendezVousAcceptes' => $rendezVousAcceptes,
        'rendezVousRefuses' => $rendezVousRefuses,
        'rendezVousEnAttente' => $rendezVousEnAttente,
    ]);
}


}
