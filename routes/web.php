<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\PrivilegeRoleController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DisciplineController;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\NoMemberController;

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

Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('root');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('campus/bunch', [CampusController::class, 'bunch']);
Route::resource('campus', CampusController::class)->except([
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
Route::get('families/mapping', [FamilyController::class, 'mapping'])->name('families.mapping');
Route::get('families/bunch', [FamilyController::class, 'bunch']);

Route::prefix('/family')->group( function() {
    Route::get('/create',  [FamilyController::class, 'create'])->name('family.create');
    Route::get('/{family}',  [FamilyController::class, 'show'])->name('family.show');

    Route::get('/{family}/createmember',  [FamilyController::class, 'createmember'])->name('family.createmember');
    Route::post('/{family_id}/addmember',  [FamilyController::class, 'addmember'])->name('family.addmember');
    Route::get('/{family_id}/editmember/{person}',  [FamilyController::class, 'editmember'])->name('family.editmember');
    Route::patch('/{family_id}/updatemember/{person}',  [FamilyController::class, 'updatemember'])->name('family.updatemember');

    Route::post('/store',  [FamilyController::class, 'store'])->name('family.store');
    Route::patch('/{family}',  [FamilyController::class, 'update'])->name('family.update');
    Route::delete('/{family}',  [FamilyController::class, 'destroy'])->name('family.destroy');
    Route::get('/{family}/edit',  [FamilyController::class, 'edit'])->name('family.edit');
});

// // Route::resource('users', UserController::class);
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::prefix('/user')->group( function() {
    Route::get('/create',  [UserController::class, 'create'])->name('user.create');

    Route::get('/change',  [UserController::class, 'change'])->name('user.change');
    Route::patch('/reset',  [UserController::class, 'reset'])->name('user.reset');

    Route::post('/store',  [UserController::class, 'store'])->name('user.store');
    Route::patch('/{user}',  [UserController::class, 'update'])->name('user.update');
    Route::get('/{user}/edit',  [UserController::class, 'edit'])->name('user.edit');
});

Route::prefix('/people')->group( function() {
    Route::get('/{person}',  [PersonController::class, 'show'])->name('person.show');
    Route::patch('/{person}',  [PersonController::class, 'update'])->name('person.update');
    Route::get('/{person}/edit',  [PersonController::class, 'edit'])->name('person.edit');
});

Route::get('members', [MemberController::class, 'index'])->name('members.index');
Route::prefix('/members')->group( function() {
    Route::get('/baptized', [MemberController::class, 'baptized'])->name('members.baptized');
    Route::get('/unbaptized', [MemberController::class, 'unbaptized'])->name('members.unbaptized');
    Route::get('/accepted', [MemberController::class, 'accepted'])->name('members.accepted');
    Route::get('/unaccepted', [MemberController::class, 'unaccepted'])->name('members.unaccepted');
    Route::get('/withdiseases', [MemberController::class, 'withdiseases'])->name('members.withdiseases');
    Route::get('/withhandicaps', [MemberController::class, 'withhandicaps'])->name('members.withhandicaps');
    Route::get('/bypreferences', [MemberController::class, 'bypreferences'])->name('members.bypreferences');
    Route::get('/queryform', [MemberController::class, 'queryform'])->name('members.queryform');
    Route::get('/queryresult', [MemberController::class, 'queryresult'])->name('members.queryresult');
});

Route::get('nomembers', [NoMemberController::class, 'index'])->name('nomembers.index');
Route::get('nomember/{person}', [NoMemberController::class, 'show']);

Route::get('directory', [AssignmentController::class, 'directory'])->name('directory');
Route::resource('assignments', AssignmentController::class)->except([
    'create', 'show'
]);

Route::patch('end/{id}', [DisciplineController::class, 'end']);
Route::resource('disciplines', DisciplineController::class)->except([
    'create', 'show'
]);
