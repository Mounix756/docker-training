<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Subscriber;


// Page d'accueil : Liste des articles avec la barre de recherche
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

// Routes CRUD automatiques (create, store, show, destroy)
Route::resource('articles', ArticleController::class)->except([
    'index',
    'edit',
    'update'
]);


Route::post('/subscribe', function (Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email|unique:subscribers,email',
    ], [
        'email.unique' => 'Vous êtes déjà abonné à notre newsletter !',
        'email.email'  => 'Veuillez saisir une adresse e-mail valide.',
    ]);

    Subscriber::create([
        'email' => $request->email,
        'is_active' => true,
    ]);

    return back()->with('success', 'Félicitations ! Vous êtes désormais inscrit à la newsletter.');
})->name('subscribers.store');

Route::get('/subscribers', function () {
    $subscribers = Subscriber::latest()->paginate(15);
    return view('subscribers.index', compact('subscribers'));
})->name('subscribers.index');
