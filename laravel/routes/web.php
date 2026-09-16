<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


// Page d'accueil : Liste des articles avec la barre de recherche
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

// Routes CRUD automatiques (create, store, show, destroy)
Route::resource('articles', ArticleController::class)->except([
    'index',
    'edit',
    'update'
]);
