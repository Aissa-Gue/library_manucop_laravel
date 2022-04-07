<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ManuscriptController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TranscriberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Auth::routes();
//disable registration options
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/', function () {
    return redirect()->route('login');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('settings', SettingController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UserController::class);

    Route::resource('countries', CountryController::class)->except('show');
    Route::resource('cities', CityController::class)->except('show');

    Route::resource('transcribers', TranscriberController::class);
    Route::resource('authors', AuthorController::class);

    /** books */
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    /** manuscripts */
    Route::get('/manuscripts', [ManuscriptController::class, 'index'])->name('manuscripts.index');
    Route::get('/manuscripts/create', [ManuscriptController::class, 'create'])->name('manuscripts.create');
    Route::get('/manuscripts/{id}/edit', [ManuscriptController::class, 'edit'])->name('manuscripts.edit');
    Route::get('/manuscripts/{id}', [ManuscriptController::class, 'show'])->name('manuscripts.show');
    Route::delete('/manuscripts/{id}', [ManuscriptController::class, 'destroy'])->name('manuscripts.destroy');
});