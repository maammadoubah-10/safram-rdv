<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medecin;
use App\Models\User;
use App\Models\Rdv;
use App\Models\Specialite;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class AdminController extends Controller
{
    public function showAdminProfile()
    {
        // Récupérez les informations de l'administrateur, par exemple depuis la base de données
        $admin = Auth::user(); // Supposons que l'administrateur est authentifié

        return view('admin.mon-compte', compact('admin'));
    }

    public function editAdminProfile()
    {
        // Récupérez les informations de l'administrateur (par exemple, depuis la base de données)
        $admin = Auth::user(); // Supposons que l'administrateur est authentifié

        return view('admin.edit-mon-compte', compact('admin'));
    }

    public function updateAdminProfile(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id, // Assurez-vous que l'email est unique, en excluant l'ID de l'administrateur actuel
            'password' => 'nullable|string|min:6', // Le mot de passe est facultatif
            'password_confirmation' => 'same:password', // Assurez-vous que la confirmation du mot de passe correspond au mot de passe
            // Ajoutez d'autres règles de validation pour d'autres champs si nécessaire
        ]);
    
        // Mettez à jour les informations du profil de l'administrateur
        $admin = Auth::user();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
    
        // Mettez à jour le mot de passe uniquement s'il est fourni
        $password = $request->input('password');
        if (!empty($password)) {
            $admin->password = bcrypt($password);
        }
    
        // Mettez à jour d'autres champs du profil ici
    
        $admin->save();
    
        return redirect()->route('admin.mon-compte')->with('success', 'Profil mis à jour avec succès.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'LIKE', "%$search%")->paginate(10);

        return view('admin.utilisateurs.indexusers', ['users' => $users]);
    }


    public function index()
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

        return view('admin.accueil', compact('data'));
    }

    public function list()
    {
        $medecins = Medecin::with('specialite')->paginate(5); // Paginate the results
        $specialites = Specialite::all();
        return view('admin.medecins.list', compact('medecins', 'specialites'));
    }


    public function addMedecin()
    {
        $specialites = Specialite::all();
        return view('admin.medecins.add', compact('specialites'));
    }

    public function storeMedecin(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'specialite_id' => 'required|exists:specialites,id',
            'tel' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'prixVisite' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Créez d'abord un nouvel utilisateur associé au médecin
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Ensuite, créez un nouveau médecin associé à cet utilisateur
        $medecin = new Medecin;
        $medecin->name = $request->input('name');
        $medecin->lastName = $request->input('lastName');
        $medecin->adresse = $request->input('adresse');
        $medecin->specialite_id = $request->input('specialite_id');
        $medecin->tel = $request->input('tel');
        $medecin->lieu = $request->input('lieu');
        $medecin->prixVisite = $request->input('prixVisite');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/public/medecin_images/');
            $image->move($path, $filename);
    
            // Enregistrez le chemin de l'image dans la base de données
            $medecin->image = 'medecin_images/' . $filename;
        }
        
    

        // Sauvegardez le médecin
        $user->medecin()->save($medecin);

        return redirect()->route('admin.medecins.list')->with('success', 'Médecin ajouté avec succès');
    }
    public function editMedecin($id)
    {
        // Recherchez le médecin en fonction de l'ID
        $medecin = Medecin::find($id);

        // Si le médecin n'est pas trouvé, vous pouvez gérer cette situation en conséquence (par exemple, renvoyer une erreur 404)
        if (!$medecin) {
            abort(404, 'Médecin non trouvé');
        }

        // Chargez également la liste des spécialités si nécessaire
        $specialites = Specialite::all();

        // Passez le médecin et les spécialités à la vue
        return view('admin.medecins.edit', compact('medecin', 'specialites'));
    }

    public function updateMedecin(Request $request, $id)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'specialite_id' => 'required|exists:specialites,id',
            'prixVisite' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Ajoutez ici d'autres règles de validation pour d'autres champs
        ]);

        // Recherche du médecin par son ID
        $medecin = Medecin::find($id);

        // Vérifiez si le médecin existe
        if (!$medecin) {
            return redirect()->route('admin.medecins.list')->with('error', 'Médecin non trouvé.');
        }

        // Mettez à jour les champs du médecin
        $medecin->name = $request->input('name');
        $medecin->specialite_id = $request->input('specialite_id');
        $medecin->prixVisite = $request->input('prixVisite');
        $medecin->lastName = $request->input('lastName');
        $medecin->adresse = $request->input('adresse');
        $medecin->lieu = $request->input('lieu');
        $medecin->tel = $request->input('tel');
        // Mettez à jour d'autres champs du médecin ici
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/' . $filename;

           
        }
        $medecin->save();

        return redirect()->route('admin.medecins.list')->with('success', 'Médecin mis à jour avec succès.');
    }

    public function deleteMedecin($id)
    {
        $medecin = Medecin::find($id);
        $medecin->delete();

        return redirect()->route('admin.medecins.list')->with('success', 'Médecin supprimé avec succès.');
    }

    public function liste()
    {
        $medecins = Medecin::with('specialite')->get();
        $specialites = Specialite::paginate(5);
        return view('admin.specialites.liste', compact('medecins', 'specialites'));
    }

    public function addSpecialite()
    {
        return view('admin.specialites.add');
    }

    public function storeSpecialite(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            // Ajoutez ici d'autres règles de validation si nécessaire
        ]);

        // Créez une nouvelle spécialité
        $specialite = new Specialite;
        $specialite->nom = $request->input('nom');
        $specialite->save();

        return redirect()->route('admin.specialites.liste')->with('success', 'Spécialité ajoutée avec succès.');
    }

    public function deleteSpecialite($id)
    {
        $specialite = Specialite::find($id);
        $specialite->delete();
        return redirect()->route('admin.specialites.liste')->with('success', 'Spécialité supprimée avec succès.');
    }

    public function editSpecialite($id)
    {
        $specialite = Specialite::find($id);
        return view('admin.specialites.edit', compact('specialite'));
    }

    public function updateSpecialite(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            // Add other validation rules if necessary
        ]);

        // Find the specialite by ID
        $specialite = Specialite::find($id);

        // Check if the specialite exists
        if (!$specialite) {
            return redirect()->route('admin.specialites.liste')->with('error', 'Specialite not found.');
        }

        // Update the specialite's attributes
        $specialite->nom = $request->input('nom');
        // Update other fields as needed

        // Save the changes
        $specialite->save();

        return redirect()->route('admin.specialites.liste')->with('success', 'Specialite updated successfully.');
    }

    public function indexusers()
    {
        $users = User::all();
        return view('admin.utilisateurs.indexusers', compact('users'));
    }

    public function blockUser(User $user)
    {
        $user->blocked = true;
        $user->save();
        return redirect()->route('admin.utilisateurs.indexusers')->with('success', 'Utilisateur bloqué avec succès.');
    }

    public function unblockUser(User $user)
    {
        $user->blocked = false;
        $user->save();
        return redirect()->route('admin.utilisateurs.indexusers')->with('success', 'Utilisateur débloqué avec succès.');
    }
    

    
}
