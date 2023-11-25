<?php

use App\Http\Controllers\MedicalController;
use App\Http\Controllers\TrainingController;
use App\Models\Brigade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrigadeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PlatoonController;
use App\Http\Controllers\SoldierController;
use App\Http\Controllers\SquadronController;
use App\Http\Controllers\UnitCompanyController;
use App\Http\Controllers\NationalArmyController;
use App\Http\Controllers\MilitaryRegionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('soldier', SoldierController::class);
    ROute::resource('nationalArmy', NationalArmyController::class);
    Route::resource('militaryRegion', MilitaryRegionController::class);
    Route::resource('brigade', BrigadeController::class);
    Route::resource('unitCompany', UnitCompanyController::class);
    Route::resource('platoon', PlatoonController::class);
    Route::resource('squadron', SquadronController::class);
    Route::resource('medical', MedicalController::class);
    Route::resource('training', TrainingController::class);
    Route::resource("leave",  LeaveController::class);
    route::post('/approved/{id}', [LeaveController::class, 'approved'])->name('approved');
});
