<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/movie/{movie_slug}', 'movieView');

    Route::get('/genre', 'genre');
    Route::get('/genre/movies_by_genre', 'movies_by_genre');

    Route::get('/performer', 'performer');
    Route::get('/performer/movies_by_performer', 'movies_by_performer');

    Route::get('/new_movies', 'new_movies');
    Route::get('/new_movies/filter', 'new_movies');

    Route::get('/search', 'searchMovies');

    // Rating Routes
    Route::post('/movie', 'store');
    Route::get('/movie/{rating_id}/delete', 'destroy');
});
//Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('creator')->middleware(['auth','isCreator'])->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Creator\DashboardController::class, 'index']);

    // Movie Routes
    Route::controller(App\Http\Controllers\Creator\MovieController::class)->group(function (){
        Route::get('/movie', 'index');
        Route::get('/movie/create', 'create');
        Route::post('/movie', 'store');
        Route::get('/movie/{movie}/edit', 'edit');
        Route::put('/movie/{movie}', 'update');
        Route::get('/movie/{movie}/delete', 'destroy');

    });
});
