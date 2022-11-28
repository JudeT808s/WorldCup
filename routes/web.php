<?php

use App\Http\Controllers\Admin\TournamentController as AdminTournamentController;
use App\Http\Controllers\User\TournamentController as UserTournamentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TournamentController;

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

// Route::get('/home', [TournamentController::class, 'home']);
Route::get('/create', [TournamentController::class, 'create']);
Route::get('/store', [TournamentController::class, 'store']);
Route::get('/show', [TournamentController::class, 'show']);

Route::resource('/tournament', TournamentController::class)->middleware(['auth']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home/tournament', [App\Http\Controllers\HomeController::class, 'tournamentIndex'])->name('home.tournament.index');


// This will create all the routes for Book
// and the routes will only be available when a user is logged in
Route::resource('/admin/books', TournamentController::class)->middleware(['auth'])->names('admin.books');

Route::resource('/user/books', TournamentController::class)->middleware(['auth'])->names('user.books')->only(['index', 'show']);