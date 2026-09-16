@extends('layouts.app')

@section('title', 'Accueil - Liste des articles')

@section('content')
    <!-- Zone de Recherche Puissante (Full-Text Search PostgreSQL) -->
    <section class="mb-10 text-center max-w-2xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-3">Explorez nos derniers articles</h1>
        <p class="text-gray-500 mb-6 text-sm">Recherche rapide sur le titre, l'auteur et le contenu.</p>

        <form action="{{ route('articles.index') }}" method="GET" class="relative">
            <div class="flex items-center shadow-sm rounded-xl overflow-hidden border border-gray-300 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 bg-white">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher un mot-clé, un sujet, un auteur..."
                    class="w-full px-5 py-3 text-sm text-gray-800 focus:outline-none"
                >
                @if(request('search'))
                    <a href="{{ route('articles.index') }}" class="px-3 text-gray-400 hover:text-gray-600 text-xs">Effacer</a>
                @endif
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 text-sm font-semibold transition">
                    Rechercher
                </button>
            </div>
        </form>

        @if(request('search'))
            <p class="text-xs text-gray-500 mt-2">
                Résultats pour la recherche : <span class="font-semibold text-gray-800">"{{ request('search') }}"</span>
            </p>
        @endif
    </section>

    <!-- Liste des Articles (Grille) -->
    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <article class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <!-- Image de couverture (1ère image de la galerie) -->
                    <div class="h-48 bg-gray-100 overflow-hidden relative">
                        @if($article->images->isNotEmpty())
                            <img
                                src="{{ asset('storage/' . $article->images->first()->image_path) }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs bg-gray-100">
                                Pas d'image
                            </div>
                        @endif

                        @if($article->images->count() > 1)
                            <span class="absolute top-3 right-3 bg-black/60 backdrop-blur-sm text-white text-xs px-2.5 py-1 rounded-full font-medium">
                                📷 {{ $article->images->count() }}
                            </span>
                        @endif
                    </div>

                    <!-- Contenu de la carte -->
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                            <span class="font-medium text-blue-600">Par {{ $article->author }}</span>
                            <time>{{ $article->created_at->format('d/m/Y') }}</time>
                        </div>

                        <h2 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition">
                            <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        </h2>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($article->content), 120) }}
                        </p>

                        <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition mt-auto">
                            Lire l'article &rarr;
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
            <p class="text-gray-500 text-base mb-4">Aucun article trouvé.</p>
            <a href="{{ route('articles.create') }}" class="text-blue-600 font-semibold hover:underline text-sm">
                Soyez le premier à publier un article &rarr;
            </a>
        </div>
    @endif
@endsection
