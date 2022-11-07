<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TournamentController;

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
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/index', function () {
//     return view('index');
// });
Route::get('/index', [TournamentController::class, 'index']);
Route::get('/create', [TournamentController::class, 'create']);
Route::get('/store', [TournamentController::class, 'store']);
Route::get('/show', [TournamentController::class, 'show']);

Route::resource('/tournament', TournamentController::class)->middleware(['auth']);



Route::get('/dashboard', function () {
    return redirect('/../index');

})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
