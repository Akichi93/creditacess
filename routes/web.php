<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ServiceController;

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
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => ['web']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Utilisateurs
    Route::get('/users', [UserController::class, 'userList']);
    Route::post('/adduser', [UserController::class, 'userAdd'])->name('user.add');
    Route::post('/uploaddoc', [UserController::class, 'uploadDoc'])->name('upload.doc');
    Route::get('/personnel', [UserController::class, 'personnel']);
    Route::get('/details/{id}', [UserController::class, 'details'])->name('users.details');

    //services
    Route::get('/services', [ServiceController::class, 'serviceList']);
    Route::post('/addservice', [ServiceController::class, 'serviceAdd'])->name('service.add');
    Route::post('/updateservice/{id}', [ServiceController::class, 'serviceUpdate'])->name('service.update');

    //Conges
    Route::get('/conges', [CongeController::class, 'congeList']);
    Route::post('/addconge', [CongeController::class, 'congeAdd'])->name('conge.add');
    Route::get('/allconge', [CongeController::class, 'congeAll']);
    Route::get('/respoconge', [CongeController::class, 'congeRespo']);
    Route::post('/validaterespoconge/{id}', [CongeController::class, 'validateRepo'])->name('conge.validaterespo');
    Route::post('/validaterhconge/{id}', [CongeController::class, 'validateRh'])->name('conge.validaterh');

    //Demande
    Route::get('/demandes', [DemandeController::class, 'demandeList']);
    Route::post('/adddemande', [DemandeController::class, 'demandeAdd'])->name('demande.add');
    Route::post('/updatedemande/{id}', [DemandeController::class, 'demandeUpdate'])->name('demande.update');

    // Mission
    Route::get('/missions', [MissionController::class, 'missionList']);
    Route::post('/addmission', [MissionController::class, 'missionAdd'])->name('mission.add');
    Route::get('/allmission', [MissionController::class, 'missionAll']);
    Route::get('/respomission', [MissionController::class, 'missionRespo']);
    // Route::post('/updatedemande/{id}', [MissionController::class, 'demandeUpdate'])->name('demande.update');
});
