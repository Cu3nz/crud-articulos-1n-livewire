<?php

use App\Http\Controllers\Socialite\GithubController;
use App\Livewire\PrincipalArticles;
use Illuminate\Support\Facades\Route;

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


    Route::get('articles' , PrincipalArticles::class ) -> name('articles.show');

});


Route::get('/auth/github/redirect' , [GithubController::class , 'redirect']) -> name('github.redirect');
Route::get('/auth/github/callback' , [GithubController::class , 'callback']) -> name('github.callback');
