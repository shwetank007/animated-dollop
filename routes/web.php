<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

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

Route::redirect('/', '/search');

Route::get('/search-page', [SearchController::class, 'searchList'])->name('search.list');

Route::resource('search', SearchController::class)->only([
    'index', 'create', 'store'
]);
