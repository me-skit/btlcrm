<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UnionTypeController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\FamilyRoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\PrivilegeRoleController;
use App\Http\Controllers\DisciplineTypeController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\FamilyController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('uniontypes', UnionTypeController::class);
Route::get('uniontypes', [UnionTypeController::class, 'index'])->name('uniontypes.index');
Route::prefix('/uniontype')->group( function() {
    Route::get('/create',  [UnionTypeController::class, 'create'])->name('uniontype.create');
    Route::post('/store',  [UnionTypeController::class, 'store'])->name('uniontype.store');
    Route::patch('/{unionType}',  [UnionTypeController::class, 'update'])->name('uniontype.update');
    Route::delete('/{unionType}',  [UnionTypeController::class, 'destroy'])->name('uniontype.destroy');
    Route::get('/{unionType}/edit',  [UnionTypeController::class, 'edit'])->name('uniontype.edit');
});

// Route::resource('campus', CampusController::class);
Route::resource('campus', CampusController::class)->except([
    'show'
]);

// Route::resource('familyroles', FamilyRoleController::class);
Route::get('familyroles', [FamilyRoleController::class, 'index'])->name('familyroles.index');
Route::prefix('/familyrole')->group( function() {
    Route::get('/create',  [FamilyRoleController::class, 'create'])->name('familyrole.create');
    Route::post('/store',  [FamilyRoleController::class, 'store'])->name('familyrole.store');
    Route::patch('/{familyRole}',  [FamilyRoleController::class, 'update'])->name('familyrole.update');
    Route::delete('/{familyRole}',  [FamilyRoleController::class, 'destroy'])->name('familyrole.destroy');
    Route::get('/{familyRole}/edit',  [FamilyRoleController::class, 'edit'])->name('familyrole.edit');
});

// Route::resource('status', StatusController::class);
Route::resource('status', StatusController::class)->except([
    'show'
]);

// Route::resource('privileges', PrivilegeController::class);
Route::get('privileges', [PrivilegeController::class, 'index'])->name('privileges.index');
Route::prefix('/privilege')->group( function() {
    Route::get('/create',  [PrivilegeController::class, 'create'])->name('privilege.create');
    Route::post('/store',  [PrivilegeController::class, 'store'])->name('privilege.store');
    Route::patch('/{privilege}',  [PrivilegeController::class, 'update'])->name('privilege.update');
    Route::delete('/{privilege}',  [PrivilegeController::class, 'destroy'])->name('privilege.destroy');
    Route::get('/{privilege}/edit',  [PrivilegeController::class, 'edit'])->name('privilege.edit');
});

// Route::resource('privilegeroles', PrivilegeRoleController::class);
Route::get('privilegeroles', [PrivilegeRoleController::class, 'index'])->name('privilegeroles.index');
Route::prefix('/privilegerole')->group( function() {
    Route::get('/create',  [PrivilegeRoleController::class, 'create'])->name('privilegerole.create');
    Route::post('/store',  [PrivilegeRoleController::class, 'store'])->name('privilegerole.store');
    Route::patch('/{privilegeRole}',  [PrivilegeRoleController::class, 'update'])->name('privilegerole.update');
    Route::delete('/{privilegeRole}',  [PrivilegeRoleController::class, 'destroy'])->name('privilegerole.destroy');
    Route::get('/{privilegeRole}/edit',  [PrivilegeRoleController::class, 'edit'])->name('privilegerole.edit');
});

// Route::resource('disciplinetypes', DisciplineTypeController::class);
Route::get('disciplinetypes', [DisciplineTypeController::class, 'index'])->name('disciplinetypes.index');
Route::prefix('/disciplinetype')->group( function() {
    Route::get('/create',  [DisciplineTypeController::class, 'create'])->name('disciplinetype.create');
    Route::post('/store',  [DisciplineTypeController::class, 'store'])->name('disciplinetype.store');
    Route::patch('/{disciplineType}',  [DisciplineTypeController::class, 'update'])->name('disciplinetype.update');
    Route::delete('/{disciplineType}',  [DisciplineTypeController::class, 'destroy'])->name('disciplinetype.destroy');
    Route::get('/{disciplineType}/edit',  [DisciplineTypeController::class, 'edit'])->name('disciplinetype.edit');
});

// Route::resource('actions', ActionController::class);
Route::get('actions', [ActionController::class, 'index'])->name('actions.index');
Route::prefix('/action')->group( function() {
    Route::get('/create',  [ActionController::class, 'create'])->name('action.create');
    Route::post('/store',  [ActionController::class, 'store'])->name('action.store');
    Route::patch('/{action}',  [ActionController::class, 'update'])->name('action.update');
    Route::delete('/{action}',  [ActionController::class, 'destroy'])->name('action.destroy');
    Route::get('/{action}/edit',  [ActionController::class, 'edit'])->name('action.edit');
});

// Route::resource('villages', VillageController::class);
Route::get('villages', [VillageController::class, 'index'])->name('villages.index');
Route::prefix('/village')->group( function() {
    Route::get('/create',  [VillageController::class, 'create'])->name('village.create');
    Route::post('/store',  [VillageController::class, 'store'])->name('village.store');
    Route::patch('/{village}',  [VillageController::class, 'update'])->name('village.update');
    Route::delete('/{village}',  [VillageController::class, 'destroy'])->name('village.destroy');
    Route::get('/{village}/edit',  [VillageController::class, 'edit'])->name('village.edit');
});

// Route::resource('families', FamilyController::class);
Route::get('families', [FamilyController::class, 'index'])->name('families.index');
Route::prefix('/family')->group( function() {
    Route::get('/create',  [FamilyController::class, 'create'])->name('family.create');
    Route::get('/{id}',  [FamilyController::class, 'show'])->name('family.show');

    Route::post('/{id}/addmember',  [FamilyController::class, 'addmember'])->name('family.addmember');
    Route::get('/{family_id}/editmember/{person}',  [FamilyController::class, 'editmember'])->name('family.editmember');
    Route::patch('/{family_id}/updatemember/{person}',  [FamilyController::class, 'updatemember'])->name('family.updatemember');

    Route::post('/store',  [FamilyController::class, 'store'])->name('family.store');
    Route::patch('/{family}',  [FamilyController::class, 'update'])->name('family.update');
    Route::delete('/{family}',  [FamilyController::class, 'destroy'])->name('family.destroy');
    Route::get('/{family}/edit',  [FamilyController::class, 'edit'])->name('family.edit');
});


// // Route::resource('people', PersonController::class);
// Route::get('people', [PersonController::class, 'index'])->name('people.index');
// Route::prefix('/person')->group( function() {
//     Route::get('/create',  [PersonController::class, 'create'])->name('person.create');
//     Route::get('/{id}',  [PersonController::class, 'show'])->name('person.show');
//     Route::post('/store',  [PersonController::class, 'store'])->name('person.store');
//     Route::patch('/{person}',  [PersonController::class, 'update'])->name('person.update');
//     Route::delete('/{person}',  [PersonController::class, 'destroy'])->name('person.destroy');
//     Route::get('/{person}/edit',  [PersonController::class, 'edit'])->name('person.edit');
// });
