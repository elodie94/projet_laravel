<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ResetMdpController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//page principale en racine
Route::get('/', function () {
    return view('main');
})->name('main');

//page home
Route::view('/home','home')
    ->middleware('auth')
    ->name('home');



//routes pour connexion et déconnexion de l'utilisateur
Route::get('/login', [AuthenticatedSessionController::class,'create'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'store']);
Route::get('/logout', [AuthenticatedSessionController::class,'destroy'])
    ->name('logout')->middleware('auth');



//          3. Pour l’utilisateur (étudiant et enseignant) :
//routes pour création d'un compte
Route::get('/register', [RegisterUserController::class,'create'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'store']);

//routes pour modifier le mot de passe
Route::get('/user/{id}/editMdp', [ResetMdpController::class,'edit'])
    ->middleware('auth')->name('editMdp');
Route::put('/user/{id}/editMdp', [ResetMdpController::class,'update'])
    ->name('updateMdp');

//routes pour modifier le nom/prénom
Route::get('/user/{id}/editnom', [UserController::class,'edit'])
    ->middleware('auth')->name('editnom');
Route::put('/user/{id}/editnom', [UserController::class,'update'])
    ->name('updatenom');


//afficher les détails sur un utilisateur
/*Route::get('/produits/{id}',[ProduitController::class,'show'])
    ->middleware('auth')->middleware('is_admin')
    ->name('produits.show');*/




//              4. Pour l’administrateur :

//page d'accueil
Route::view('admin','admin.admin_home')
    ->middleware('auth')->middleware('is_admin')
    ->name('admin.home');


// GESTION DES UTILISATEURS
//Afficher la liste des utilisateurs
Route::get('/users',[UserController::class,'index'])
    ->middleware('auth')->middleware('is_admin')
    ->name('user.index');



//routes pour accepter ou refuser un utilisateur qui a été auto-créé
//Afficher la liste des utilisateurs en attente de validation de compte
Route::get('/users/indexvu',[UserController::class,'indexvu'])
    ->middleware('auth')->middleware('is_admin')
    ->name('admin.users.indexvu');

//accepter
Route::get('/admin/users/{id}/editType', [UserController::class,'editType'])
    ->middleware('auth')->middleware('is_admin')
    ->name('editType');
Route::put('/admin/users/{id}/editType', [UserController::class,'updateType'])
    ->name('updateType');

//refus
Route::get('admin/users/{id}/delete',[UserController::class,'delete'])
    ->middleware('auth')->middleware('is_admin')
    ->name('admin.delete');

Route::delete('admin/users/{id}/delete',[UserController::class,'destroy'])->name('admin.destroy');


//Association d''un cours avec un enseignant
Route::get('/admin/coursteacher', [AdminController::class,'assoProfCoursForm'])
    ->middleware('auth')->middleware('is_admin')
    ->name('assoPCform');
Route::post('/admin/coursteacher', [AdminController::class,'assoProfCours'])
    ->name('assoPC');


// GESTION DES COURS
//Afficher la liste des cours
Route::get('/cours',[CoursController::class,'index'])
    ->middleware('auth')->middleware('is_admin')
    ->name('admin.cours.index');

//Créer/ajouter un nouveau cours
Route::get('/cours/create',[CoursController::class,'create'])->middleware('auth')
    ->name('admin.cours.create')->middleware('is_admin');
Route::post('/cours/create',[CoursController::class,'store'])->name('admin.cours.store');

//rechercher un cours
Route::get('/admin/cours/recherche_cours',[CoursController::class,'rechercheCours'])
    ->middleware('auth') ->middleware('is_admin')
    ->name('admin.cours.rechercheCours');
Route::post('/admin/cours/recherche_cours',[CoursController::class,'resultRecherche'])
    ->name('admin.cours.resultRecherche');

// GESTION DES FORMATIONS
//Afficher la liste des formations
Route::get('/formations',[FormationController::class,'index'])
    ->middleware('auth')->middleware('is_admin')
    ->name('admin.formations.index');

//routes pour créer/ajouter une nouvelle formation
Route::get('/formations/create',[FormationController::class,'create'])
    ->middleware('auth')->middleware('is_admin')
    ->name('admin.formations.create');
Route::post('/formations/create',[FormationController::class,'store'])->name('admin.formations.store');



//              1. Pour les étudiants :

//Liste des cours de la formation de l'étudiant
Route::get('/user/etudiant/{id}/cours',[EtudiantController::class,'indexCours'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.cours.index');

//page pour la gestion d'inscription
Route::view('/user/etudiant/gestioninscr_home','user.etudiant.etu_inscrcours_home')
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.gestioninscr_home');

//GESTION DES INSCRIPTIONS
//inscription cours
Route::get('/user/etudiant/{id}/inscription_cours',[EtudiantController::class,'inscrCours'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.cours.inscrCours');
Route::post('/user/etudiant/{id}/inscription_cours',[EtudiantController::class,'storeInscrCours'])
    ->name('user.etudiant.cours.storeInscrCours');

//désinscription d'un cours
Route::get('/users/etudiant/cours/{id}/delete',[EtudiantController::class,'desinscrCours'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.cours.desinscrCours');

Route::delete('/users/etudiant/cours/{id}/delete',[EtudiantController::class,'destroyCoursInscr'])
    ->name('user.etudiant.cours.destroyCoursInscr');

//liste des cours dans lesquels l'étudiant est inscrit
Route::get('/user/etudiant/{id}/cours_inscrit',[EtudiantController::class,'indexCoursInscr'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.cours.indexCoursInscr');

//Recherche d'un cours dans une formation dont l'étudiant est inscrit
Route::get('/user/etudiant/recherche_cours',[EtudiantController::class,'rechercheCours'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.cours.rechercheCours');
Route::post('/user/etudiant/{id}/recherche_cours',[EtudiantController::class,'resultRecherche'])
    ->name('user.etudiant.cours.resultRecherche');

//Route::get('/user/etudiant/cours/{id}/resultat',[EtudiantController::class,'show'])->name('.show');

//  Affichage du planning personnalisé (uniquement les séances des cours auxquels cet étudiant est inscrit)

//page pour l'affichage du planning
Route::view('/user/etudiant/gestionplanning','user.etudiant.gestionplanning')
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.gestionplanning');

//affichage du planning intégrale
Route::get('/user/etudiant/{id}/planning',[PlanningController::class,'indexIntegrale'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.planning.indexIntegrale');

//affichage du planning par cours
Route::get('/user/etudiant/{id}/planning/indexCours',[PlanningController::class,'indexCours'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.planning.indexCours');

Route::get('/user/etudiant/planning/cours/{id}',[PlanningController::class,'showCours'])
    ->middleware('auth')
    ->name('user.etudiant.planning.showCours');

//affichage du planning par semaine
Route::get('/user/etudiant/planning/indexSemaine',[PlanningController::class,'indexSemaine'])
    ->middleware('auth')
    ->middleware('isEtudiant')
    ->name('user.etudiant.planning.indexSemaine');
Route::post('/user/etudiant/{id}/planning/showSemaine',[PlanningController::class,'showSemaine'])
    ->name('user.etudiant.planning.showSemaine');


//              2. Pour les enseignants :
//liste des cours dont l'enseignant est responsable
Route::get('/user/enseignant/{id}/cours',[EnseignantController::class,'indexCours'])
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.cours.index');

//  Affichage du planning personnalisé (uniquement les séances des cours auxquels cet étudiant est inscrit)



//page pour l'affichage du planning
Route::view('/user/enseignant/showplanning','user.enseignant.showplanning')
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.showplanning');

//affichage du planning intégrale
Route::get('/user/enseignant/{id}/planning',[EnseignantController::class,'indexIntegrale'])
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.planning.indexIntegrale');

//affichage du planning par cours
Route::get('/user/enseignant/{id}/planning/indexCours',[EnseignantController::class,'indexPC'])
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.planning.indexPC');

Route::get('/user/enseignant/planning/cours/{id}',[EnseignantController::class,'showCours'])
    ->middleware('auth')
    ->name('user.enseignant.planning.showCours');

//affichage du planning par semaine
Route::get('/user/enseignant/planning/indexSemaine',[EnseignantController::class,'indexSemaine'])
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.planning.indexSemaine');
Route::post('/user/enseignant/{id}/planning/showSemaine',[EnseignantController::class,'showSemaine'])
    ->name('user.enseignant.planning.showSemaine');


//  GESTION DU PLANNING
//page pour la gestion du planning
Route::view('/user/enseignant/gestionplanning_home','user.enseignant.gestionplanning_home')
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.gestionplanning_home');

//créer une nouvelle séance
Route::get('/user/enseignant/{id}/planning/new_seance',[PlanningController::class,'create'])
    ->middleware('auth')
    ->middleware('isEnseignant')
    ->name('user.enseignant.planning.create');
Route::post('/user/enseignant/{id}/planning/new_seance',[PlanningController::class,'store'])
    ->name('user.enseignant.planning.store');
