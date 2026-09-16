@extends('layouts.app')

@section('title', 'DevBlog - Accueil')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-b from-blue-50/50 to-transparent pt-12 pb-16 border-b border-slate-200/60 mb-12">
        <div class="max-w-4xl mx-auto text-center px-4">
            <span class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-100/80 text-blue-700 text-xs font-semibold mb-6">
                <span>✨ Bienvenue sur DevBlog</span>
            </span>

            <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                Des idées, du code et des <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">histoires captivantes</span>.
            </h1>

            <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Explorez nos articles de blog ou partagez votre savoir avec notre communauté.
            </p>

            <!-- Barre de Recherche PostgreSQL -->
            <form action="{{ route('articles.index') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="relative flex items-center shadow-lg shadow-slate-200/50 rounded-2xl overflow-hidden bg-white border border-slate-200 p-1.5 focus-within:ring-2 focus-within:ring-blue-500 transition">
                    <svg class="w-5 h-5 text-slate-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par sujet, mot-clé ou auteur..."
                        class="w-full px-4 py-3 text-sm text-slate-900 placeholder-slate-400 focus:outline-none bg-transparent"
                    >

                    @if(request('search'))
                        <a href="{{ route('articles.index') }}" class="px-3 text-xs text-slate-400 hover:text-slate-600">Effacer</a>
                    @endif

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-3 rounded-xl transition">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grille des Articles -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(request('search'))
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-xl font-bold text-slate-900">Résultats pour <span class="text-blue-600">"{{ request('search') }}"</span></h2>
                <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">&larr; Voir tous les articles</a>
            </div>
        @endif

        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">

                        <!-- Image de Couverture avec Badge Galeries -->
                        <div class="h-52 bg-slate-100 overflow-hidden relative">
                            @if($article->images->isNotEmpty())
                                <img
                                    src="{{ asset('storage/' . $article->images->first()->image_path) }}"
                                    alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs bg-slate-100 font-medium">
                                    Aucune image
                                </div>
                            @endif

                            @if($article->images->count() > 1)
                                <span class="absolute top-4 right-4 bg-slate-900/70 backdrop-blur-md text-white text-xs px-2.5 py-1 rounded-full font-semibold border border-white/20">
                                    📸 +{{ $article->images->count() - 1 }}
                                </span>
                            @endif
                        </div>

                        <!-- Contenu -->
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center space-x-2 text-xs font-semibold text-slate-500 mb-3">
                                <span class="text-blue-600 font-bold">● {{ $article->author }}</span>
                                <span>&bull;</span>
                                <time>{{ $article->created_at->format('d M Y') }}</time>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition line-clamp-2 leading-snug">
                                <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                            </h3>

                            <p class="text-slate-600 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-700 transition mt-auto group-hover:translate-x-1 duration-200">
                                Lire l'article
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-200/80 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">?</div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Aucun article trouvé</h3>
                <p class="text-slate-500 text-sm mb-6">Essayez avec un autre terme de recherche ou publiez le premier article.</p>
                <a href="{{ route('articles.create') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-blue-600 text-white font-semibold text-sm shadow-md hover:bg-blue-700 transition">
                    Créer un article
                </a>
            </div>
        @endif
    </div>
@endsection
