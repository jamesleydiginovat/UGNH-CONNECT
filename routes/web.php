<?php

use App\Http\Controllers\anneesAccademiques;
use App\Http\Controllers\coursController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\dossierController;
use App\Http\Controllers\esalle\homeController;
use App\Http\Controllers\etudiantController;
use App\Http\Controllers\facultesController;
use App\Http\Controllers\financesController;
use App\Http\Controllers\historiqueController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\notesController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\personnelsController;
use App\Http\Controllers\professeursController;
use App\Http\Controllers\ProfileUtilisateurController;
use App\Http\Controllers\utilisateursController;
use App\Http\Controllers\validationNotesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('acceuil');

Route::get('/annee-accademique', [anneesAccademiques::class , 'show'])->name('annees-accademique')->middleware('auth','permissionMiddleware:Gestion des annnées accademiques');

Route::get('/tableau-de-bord-general', [dashboard::class , 'show'])->name('dashboard-general')->middleware('auth','permissionMiddleware:Tableau de bord général');

Route::get('/gestion-des-etudants', [etudiantController::class , 'show'])->name('gestion-des-etudiants')->middleware('auth','permissionMiddleware:Gestion des étudiants');

Route::get('/gestion-des-personnels', [personnelsController::class , 'show'])->name('gestion-des-personnels')->middleware('auth','permissionMiddleware:Gestion des personnels');

Route::get('/gestion-des-professeurs', [professeursController::class , 'show'])->name('gestion-des-professeurs')->middleware('auth','permissionMiddleware:Gestion des professeurs');

Route::get('/gestion-des-cours', [coursController::class , 'show'])->name('gestion-des-cours')->middleware('auth','permissionMiddleware:Gestion des cours et programmes');

Route::get('/gestion-des-utilisateur-et-roles', [utilisateursController::class , 'show'])->name('gestion-des-utilisateurs')->middleware('auth','permissionMiddleware:Gestion des utilisateurs et rôles');

Route::get('/gestion-des-finances', [financesController::class , 'show'])->name('gestion-des-finances')->middleware('auth','permissionMiddleware:Gestion des finances');

Route::get('/gestion-des-notes', [notesController::class , 'show'])->name('gestion-des-notes')->middleware('auth','permissionMiddleware:Gestion des évaluations et résultats');

Route::get('/mon-profile', [ProfileUtilisateurController::class , 'show'])->name('mon-profile')->middleware('auth');

Route::get('/gestion-des-dossiers', [dossierController::class , 'show'])->name('gestion-des-dossiers')->middleware('auth','permissionMiddleware:Gestion des dossiers et archives');

Route::get('/gestion-des-facultes', [facultesController::class , 'show'])->name('gestion-des-facultes')->middleware('auth','permissionMiddleware:Gestion des facultés et des décanats');

Route::get('/connexion', [loginController::class , 'show'])->name('login');

Route::get('/logout', [logoutController::class , 'logout'])->name('logout')->middleware('auth');

Route::get('/pdf', [pdfController::class , 'listepdf'])->name('listepdf')->middleware('auth');

Route::get('/gestion-des-tracabilites', [historiqueController::class , 'show'])->name('historique')->middleware('auth');

Route::get('/gestion-des-validation-Notes', [validationNotesController::class , 'show'])->name('validationNotes')->middleware('auth');


Route::prefix('esalle')->group(function () {
    Route::get('/', [homeController::class , 'show'])->name('home')->middleware('esalle.auth');
    Route::get('/logout', [homeController::class , 'logout'])->name('esalle.logout')->middleware('esalle.auth');
    Route::get('/informations', [homeController::class , 'showInformations'])->name('informations')->middleware('esalle.auth');
    Route::get('/situtionsFinancier', [homeController::class , 'showsitutionsFinancier'])->name('situtionsFinancier')->middleware('esalle.auth');
    Route::get('/coursHoraire', [homeController::class , 'showcoursHoraire'])->name('coursHoraire')->middleware('esalle.auth');
    Route::get('/notes', [homeController::class , 'showNotes'])->name('notes')->middleware('esalle.auth');
    Route::get('/chatGroup', [homeController::class , 'showChat'])->name('chatGroup')->middleware('esalle.auth');
    Route::get('/mot-de-passe', [homeController::class , 'enterPassword'])->name('enterPassword')->middleware('esalle.auth');
    // coursHoraire
});

