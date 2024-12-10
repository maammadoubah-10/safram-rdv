<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController; // Assurez-vous d'importer le contrôleur
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\MedecinController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\PatientController; 
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\MessageController;

Route::get('/admin/medecin/add', [AdminController::class, 'addMedecin'])->name('admin.medecin.add');
Route::post('/admin/medecin/store', [AdminController::class, 'storeMedecin'])->name('admin.medecin.store');


Route::get('/patient/accueilPatient', [PatientController::class, 'accueilPatient'])->name('patient.accueilPatient')->middleware('patient');
Route::get('/admin/accueil', [AdminController::class, 'index'])->name('admin.home')->middleware('admin');
Route::get('/medecin/accueil', [MedecinController::class, 'accueil'])->name('medecin.accueil')->middleware('medecin');

Route::get('admin/medecins/list', [AdminController::class, 'list'])->name('admin.medecins.list');
Route::get('admin/medecin/{id}/edit', [AdminController::class,'editMedecin'])->name('admin.medecin.edit');

// Afficher le profil du medecin
Route::middleware(['auth', 'medecin'])->group(function () {
    Route::get('/medecin/compte/profil', [MedecinController::class, 'profil'])->name('medecin.compte.profil');
});


// Afficher le formulaire d'ajout de disponibilité
Route::get('/medecin/disponibilite/create', [MedecinController::class, 'create'])->name('disponibilite.create');

// Enregistrer la disponibilité
Route::post('/medecin/disponibilite/store', [MedecinController::class, 'store'])->name('disponibilite.store');

// Liste des disponibilités (peut être une page différente)
Route::get('/medecin/disponibilite/index', [MedecinController::class, 'index'])->name('disponibilite.index');
Route::get('/medecin/disponibilite/add', [MedecinController::class, 'addDisponibilite'])->name('medecin.disponibilite.add');



//Recherche de medecin pour les patients
Route::get('/patient/recherche-medecin', [PatientController::class, 'rechercheMedecin'])->name('patient.recherche-medecin');


// Afficher le profil du patient
Route::middleware(['auth'])->group(function () {
    Route::get('/patient/compte/profil', [PatientController::class, 'profil'])->name('patient.compte.profil');
});

// Liste des rendez-vous des patient
Route::get('/patient/historique-rendezvous', [PatientController::class, 'historiqueRendezVous'])->name('patient.historique-rendezvous');



// Affiche les nom des patient qui ont rendez-vous avec le medecin
Route::get('medecin/dossiers-patients', [MedecinController::class, 'dossierpatient'])->name('medecin.dossiers-patients');

// Créer un dossier médical pour un patient
Route::get('medecin/creer-dossier-medical/{patientId}', [MedecinController::class, 'creerDossierMedicalPatient'])->name('medecin.create-dossier-medical');

// Afficher les rendez-vous à venir
Route::get('/medecin/rendezvous-avenir', [MedecinController::class, 'rendezVousAVenir'])->name('medecin.rendezvous-avenir');

// Modifier ses disponibilité
Route::get('/medecin/disponibilite/edit/{id}', [MedecinController::class, 'editDisponibilite'])->name('medecin.disponibilite.edit');
Route::put('/medecin/disponibilite/update/{id}', [MedecinController::class, 'updateDisponibilite'])->name('medecin.disponibilite.update');
Route::put('/medecin/disponibilite/update/{id}', [MedecinController::class, 'updateDisponibilite'])->name('medecin.disponibilite.update');

// Ajoutez cette route à votre fichier web.php
// Ajoutez cette route pour la suppression
Route::get('/medecin/disponibilite/delete/{id}', [MedecinController::class, 'deleteDisponibilite'])->name('medecin.disponibilite.delete');


Route::get('/medecin/disponibilite/list', [MedecinController::class, 'listDisponibilites'])->name('medecin.disponibilite.list');


// Ajout des information du patient
Route::post('/patient/storeInfo', [PatientController::class, 'storeInfo'])->name('patient.storeInfo');

// Liste des information du patient
Route::get('/patient/compte/info', [PatientController::class, 'showInfo'])->name('patient.info');

//Modifier les information du patient
Route::get('/patient/compte/edit', [PatientController::class, 'editInfo'])->name('patient.edit');
Route::put('/patient/updateInfo', [PatientController::class, 'updateInfo'])->name('patient.updateInfo');


Route::get('/patient/rdv/accueil', [PatientController::class, 'accueil'])->name('patient.rdv.accueil')->middleware('auth');
Route::get('/patient/rdv/recherche', [PatientController::class, 'recherche'])->name('patient.rdv.recherche')->middleware('auth');

Route::get('/patient/rdv/resultats', [PatientController::class, 'resultats'])->name('patient.rdv.resultats');

Route::get('/prendreRvd', [PatientController::class, 'prendreRvd'])->name('patient.prendreRvd');
Route::get('/search-medecin', [PatientController::class, 'rechercherMedecin'])->name('patient.search-medecin');

//liste des rendez-vous accepter
Route::get('/patient/rdv/rdv_accepter', [RendezVousController::class, 'afficherRdvAcceptes'])->name('patient.rdv.rdv_accepter');
//liste des rendez-vous refuser
Route::get('/patient/rdv/rdv_refuser', [RendezVousController::class, 'afficherRdvRefuser'])->name('patient.rdv.rdv_refuser');
//liste des rendez-vous en attente
Route::get('/patient/rdv/rdv_en_attente', [RendezVousController::class, 'afficherRdvAttente'])->name('patient.rdv.rdv_en_attente');




Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');;
Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
Route::get('/messages/show/{id}', [MessageController::class, 'show'])->name('messages.show');
Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');


//Afficher les disponibilité des medecins
Route::get('/prendre-rendez-vous/{medecin}', [RendezVousController::class, 'afficherDisponibilites'])->name('afficher-disponibilites');
// Afficher la page pour décrire son rendez-vous
Route::get('/patient/rdv/description/{medecin}/{disponibilite_id}', [RendezVousController::class, 'afficherFormulaire'])->name('patient.rdv.description');
Route::post('/enregistrerRdv/{medecinId}/{disponibiliteId}', [RendezVousController::class, 'enregistrer'])->name('patient.rdv.enregistrer');

// Afficher la page de confirmation de rendez-vous
Route::get('patient/rdv/confirmation', [RendezVousController::class, 'confirmation'])->name('patient.rdv.confirmation');
// Lister les médecins
Route::get('/liste-medecins', [PatientController::class, 'listeMedecins'])->name('liste-medecins');
// Afficher les détails du médecin

// Mes rendez-vous à venir
Route::get('/medecin/mes-rendezvous', [MedecinController::class, 'mesRendezVous'])->name('medecin.mes_rendezvous');
// Accepter les rdv
Route::get('/medecin/{id}/confirm', [RendezVousController::class, 'confirm'])->name('confirm-rdv');
// Refuser les rdv
Route::get('/medecin/{id}/reject', [RendezVousController::class, 'reject'])->name('reject-rdv');



Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');




// Affichage de la Statistique
Route::get('admin/statistiques/statistics', [RendezVousController::class, 'showStatistics'])->name('statistics');

// Profil de l'administrateur
Route::get('admin/mon-compte', [AdminController::class, 'showAdminProfile'])->name('admin.mon-compte');
Route::get('admin/mon-compte/edit', [AdminController::class, 'editAdminProfile'])->name('admin.mon-compte.edit');
Route::post('admin/mon-compte/update', [AdminController::class, 'updateAdminProfile'])->name('admin.mon-compte.update');

// Profil Médecins
Route::get('/medecin/edit/{id}', [MedecinController::class, 'edit'])->name('medecin.edit');
Route::put('/medecin/update/{id}', [MedecinController::class, 'update'])->name('medecin.update');



// Route pour afficher la page de création de dossiers médicaux et traiter le formulaire
Route::match(['get', 'post'], '/medecin/create-dossier-medical/{patientId}', [MedecinController::class, 'createDossierMedical'])->name('medecin.create-dossier-medical');

// Afficher le dossier médical d'un patient
Route::get('/medecin/dossier-medical/{user}', [MedecinController::class, 'viewDossierMedical'])->name('medecin.dossier-medical');

// Modifier un dossier médical
Route::get('/medecin/edit-dossier-medical/{patientId}', [MedecinController::class, 'editDossierMedical'])->name('medecin.edit-dossier-medical');
Route::put('/medecin/update-dossier-medical/{patientId}', [MedecinController::class, 'updateDossierMedical'])->name('medecin.update-dossier-medical');

// Voir mon dossier médical (Patients)
Route::get('/patient/mon-dossier-medical', [PatientController::class, 'listeDossiersMedicaux'])->name('patient.liste-dossiers-medicaux');
// Voir mon dossier médical d'un Patient spécifique
Route::get('/patient/voir-dossier-medical/{dossierId}', [PatientController::class, 'voirDossierMedical'])->name('patient.voir-dossier-medical');


Route::get('/admin/block/{user}', [AdminController::class, 'blockUser'])->name('admin.block');
Route::get('/admin/unblock/{user}', [AdminController::class, 'unblockUser'])->name('admin.unblock');

Route::get('admin/utilisateurs/indexusers',[AdminController::class,'indexusers'])->name('admin.utilisateurs.indexusers');

Route::put('/admin/medecin/update/{id}', [AdminController::class, 'updateMedecin'])->name('admin.medecin.update');
Route::get('/admin/medecin/{id}/delete', [AdminController::class,'deleteMedecin'])->name('admin.medecin.delete');
Route::get('/admin/medecin/add', [AdminController::class,'addMedecin'])->name('admin.medecin.add');
Route::post('/admin/medecin/store', [AdminController::class,'storeMedecin'])->name('admin.medecin.store');

Route::get('/admin/specialites/liste', [AdminController::class,'liste'])->name('admin.specialites.liste');
Route::get('/admin/specialites/add', [AdminController::class,'addSpecialite'])->name('admin.specialite.add');
Route::post('/admin/specialites/add', [AdminController::class,'storeSpecialite'])->name('admin.specialite.store');
Route::put('/admin/specialites/update/{id}', [AdminController::class, 'updateSpecialite'])->name('admin.specialite.update');
Route::delete('/admin/specialites/delete/{id}', [AdminController::class,'deleteSpecialite'])->name('admin.specialite.delete');
Route::get('/admin/specialites/{id}/edit', [AdminController::class,'editSpecialite'])->name('admin.specialite.edit');
Route::get('/', function () {
    return view('accueil');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
