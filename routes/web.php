<?php

use App\Http\Controllers\Controller;
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
    /** home */
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /** dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    /** search */
    //search in manuscripts
    Route::view('/search/quick/manuscripts', 'search.quick')->name('search.quick.manuscripts');
    Route::get('/search/quick/manuscripts/results', [ManuscriptController::class, 'quickSearch'])->name('search.quick.manuSearch');
    Route::view('/search/advanced/manuscripts', 'search.advanced')->name('search.advanced.manuscripts');
    Route::get('/search/advanced/manuscripts/results', [ManuscriptController::class, 'advancedSearch'])->name('search.advanced.manuSearch');
    //search in transcribers
    Route::view('/search/quick/transcribers', 'search.quick')->name('search.quick.transcribers');
    Route::get('/search/quick/transcribers/results', [TranscriberController::class, 'quickSearch'])->name('search.quick.transSearch');
    //search in books
    Route::view('/search/quick/books', 'search.quick')->name('search.quick.books');
    Route::get('/search/quick/books/results', [BookController::class, 'quickSearch'])->name('search.quick.bookSearch');

    /** countries */
    Route::resource('countries', CountryController::class)->except('show');

    /** cities */
    Route::resource('cities', CityController::class)->except('show');

    /** transcribers */
    Route::resource('transcribers', TranscriberController::class);

    /** authors */
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

Route::group(['middleware' => ['auth', 'admin']], function () {
    /** users */
    Route::get('/settings/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/settings/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/settings/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/settings/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    /** database */
    Route::get('/settings/database', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/exportDB', [SettingController::class, 'exportDB'])->name('exportDB');
    Route::post('/settings/importDB', [SettingController::class, 'importDB'])->name('importDB');
    Route::delete('/settings/dropDB', [SettingController::class, 'dropDB'])->name('dropDB');
});