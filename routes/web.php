<?php

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

Route::get('/', function () {
    return view('welcome');
});

//deconnexion utilsateurcourant
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get("/profile","ProfileController@index");
// /matieres
Route::get('/matieres','MatiereController@index');
Route::get('/matiere/{id}','MatiereController@show');

// gestion des ressources des matières
//------------------------------------
Route::get('/ressources/delete/{id}','RessourcesController@delete');
Route::post('/ressources/add','RessourcesController@add');
Route::get('/ressources/get/{id}','RessourcesController@getRessource');


// classes
Route::get('/niveaux','NiveauController@index');
Route::get('/niveau/{id}','NiveauController@show');
Route::post('/niveau/ajouter_matiere','NiveauController@ajouterMatiere');

//lien de téléchargement avec paramètre id => id table ressource

// ROLE MANAGEMENT
// TODO: si on a déjà un utilisateur de login et de mot de passe
// connu, ne peremttre l'accès à ces routes /roles que seulement
// aux admininistrateurs
//-----------------


// interface pour la configuration
Route::get('/roles/config','RoleController@config');
// appelé lorsque l'on soumet la formulaire dans /roles/config
Route::post('/roles/save','RoleController@save');
// liste des utilisateurs avec leurs rôles et le(s) niveau(x) auquel ils appartiennent
Route::get('/roles/index','RoleController@index');

Route::get('/mon_profile','RoleController@profile');


Auth::routes(['verify'=>true]);


Route::get('/home', 'HomeController@index')->name('home');

