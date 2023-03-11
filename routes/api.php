<?php

use App\Http\Controllers\SlotController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AbilitiesController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\RunningOrderController;
use App\Http\Controllers\ShowUserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Authentification*/

Route::post('/auth/register', [AuthController::class, 'createUser']);

Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');

// Déconnexion

Route::middleware('auth:sanctum')->get('/auth/logout', [AuthController::class, 'logout']);

// Permission

// middleware('auth:sanctum')-> authorization
// middleware(["auth:sanctum", "role:staff"])-> authorisation staff
// middleware(["auth:sanctum", "role:admin"])-> authorisation staff
/* _________________________________EVENTS*/


Route::get('/events', [EventController::class, 'index'])
    ->name('events.index');

Route::get('/events/{id}', [EventController::class, 'show'])
    ->name('events.show');

Route::middleware('auth:sanctum')->post('/events', [EventController::class, 'store'])
    ->name('events.store');

Route::middleware('auth:sanctum')->put('/events/{id}', [EventController::class, 'update'])
    ->name('events.update');

//Route pour suppr les evenements crees
Route::middleware('auth:sanctum')->delete('/events/{id}', [EventController::class, 'destroy'])
    ->name('events.destroy');

/* _________________________________SLOTS*/
Route::get('/events/{event_id}/slots', [SlotController::class, 'index'])->name('slots.index');

Route::post('/slots', [SlotController::class, 'store'])->name('slots.store');

/* _________________________________GROUPS*/

/**
 * La route "groups.index" donne la liste des groupes liés à l'événement consulté, on lui passe donc event_id en argument {id}
 */
Route::get('/events/{event_id}/groups', [GroupController::class, 'index'])
    ->name('groups.index');

Route::get('/groups/{group_id}', [GroupController::class, 'show'])
    ->name('groups.show');

Route::post('/groups', [GroupController::class, 'store'])
    ->name('groups.store');


/* ________________EVENT USERS_________*/
Route::middleware("auth:sanctum")->get('/event-users', [EventUserController::class, 'index'])
    ->name('event-users.index');

Route::middleware("auth:sanctum")->get('/event-users/{id}', [EventUserController::class, 'show'])
    ->name('event-users.show');

Route::middleware("auth:sanctum")->post('/event-users', [EventUserController::class, 'store'])
    ->name('event-users.store');
// middleware("auth:sanctum")-> // 

/* _________________________________GROUP USER */

/**
 * Route pour l'affichage des participants qui font partie d'un groupe dont on connaît l'id : {group_id}
 */
Route::middleware("auth:sanctum")->get('/group-users/{group_id}', [GroupUserController::class, 'index'])
    ->name('group-users.index');

Route::middleware("auth:sanctum")->post('/group-users', [GroupUserController::class, 'store'])
    ->name('group-users.store');



/*_________________________________RUNNING ORDERS */

Route::middleware('auth:sanctum')->post('/running-orders', [RunningOrderController::class, 'store'])
    ->name('running-orders.store');

// _________________________________USER
Route::middleware("auth:sanctum")->get('/profil/{id}', [ProfilController::class, 'show'])
    ->name('profil.show');

// Lire la table user pour afficher les infos dans profil
Route::middleware("auth:sanctum")->get('/my-profile', [ProfilController::class, 'showOwn'])
    ->name('my-profile.showOwn');

// Lire la table user pour afficher les infos dans profil
Route::middleware("auth:sanctum")->put('/update-profile', [ProfilController::class, 'update'])
    ->name('update-profile.update');



/* _________________________________Authentification*/

// Attribution du role admin
// Route::middleware((['auth', 'role:admin']))->group(function () {

// });

Route::middleware("auth:sanctum")->post('/roles', [ProfilController::class, 'store'])
    ->name('roles.store');



/*Les compétences*/

Route::middleware("auth:sanctum")->post('/abilities', [AbilitiesController::class, 'store'])
    ->name('abilities.store');

Route::get('/abilities', [AbilitiesController::class, 'index'])
    ->name('abilities.index ');


/* __________________ADMIN________*/
Route::middleware('auth:sanctum')->get('/admin', [AdminController::class, 'index'])->name('admin.index');

/* ShowUser affichage des users */

Route::middleware('auth:sanctum')->get('/showusers', [ShowUserController::class, 'index'])
    ->name('showusers.index');
