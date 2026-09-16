<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subscriber;
use App\Mail\ArticlePublishedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Affichage des articles avec le moteur de recherche PostgreSQL.
     */
    public function index(Request $request)
    {
        $query = Article::with('images')->latest();

        if ($request->filled('search')) {
            $query->search($request->input('search'));
        }

        $articles = $query->paginate(9);

        return view('articles.index', compact('articles'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Enregistrement de l'article, des images et notification mail.
     */
    public function store(Request $request)
    {
        // 1. Validation avec le champ 'author'
        $validated = $request->validate([
            'title'              => 'required|string|max:255',
            'author'             => 'required|string|max:255',
            'content'            => 'required|string',
            'images'             => 'nullable|array|max:4',
            'images.*'           => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'notify_subscribers' => 'nullable|boolean',
        ]);

        // 2. Création de l'article
        $article = Article::create([
            'title'              => $validated['title'],
            'author'             => $validated['author'],
            'content'            => $validated['content'],
            'notify_subscribers' => $request->has('notify_subscribers'),
        ]);

        // 3. Traitement des images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('articles', 'public');
                $article->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        // 4. Envoi ciblé uniquement aux abonnés actifs
        if ($article->notify_subscribers) {
            $subscribers = Subscriber::where('is_active', true)->get();
            foreach ($subscribers as $subscriber) {
                // Remplacer queue() par send() pour un envoi immédiat
                Mail::to($subscriber->email)->send(new ArticlePublishedMail($article));
            }
        }

        return redirect()->route('articles.index')
            ->with('success', 'Article publié avec succès !');
    }

    /**
     * Consultation d'un article.
     */
    public function show(Article $article)
    {
        $article->load('images');

        return view('articles.show', compact('article'));
    }

    /**
     * Suppression de l'article et de ses fichiers physiques.
     */
    public function destroy(Article $article)
    {
        // Suppression des fichiers du disque de stockage
        foreach ($article->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article et images supprimés.');
    }
}
