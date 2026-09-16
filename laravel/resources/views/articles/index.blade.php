@extends('layouts.app')

@section('title', 'DevBlog | Publications & Articles Techniques')

@section('content')

    <!-- Hero Section Éditorial -->
    <section class="bg-white border-b border-slate-200/80 py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Texte & Recherche -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-md bg-slate-100 border border-slate-200 text-slate-700 text-xs font-medium">
                        <span>Revue technique de développement web</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Architecture logicielle, conteneurisation & développement moderne.
                    </h1>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed max-w-2xl">
                        Analyses approfondies, retours d'expérience et guides pratiques sur le développement d'applications scalables et la gestion d'infrastructures conteneurisées.
                    </p>

                    <!-- Moteur de Recherche -->
                    <form action="{{ route('articles.index') }}" method="GET" class="pt-2">
                        <div class="flex items-center rounded-xl bg-slate-50 border border-slate-300 p-1.5 focus-within:ring-2 focus-within:ring-slate-900 focus-within:bg-white transition">
                            <svg class="w-5 h-5 text-slate-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Rechercher un sujet (ex: Docker, PostgreSQL, Laravel)..."
                                class="w-full px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400 bg-transparent focus:outline-none"
                            >
                            @if(request('search'))
                                <a href="{{ route('articles.index') }}" class="px-3 text-xs text-slate-500 hover:text-slate-800 font-medium">Réinitialiser</a>
                            @endif
                            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-medium text-sm px-5 py-2.5 rounded-lg transition">
                                Rechercher
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Image Hero d'illustration professionnelle -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-xl bg-slate-900 aspect-[4/3]">
                        <img
                            src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1000&q=80"
                            alt="Code & Architecture"
                            class="w-full h-full object-cover opacity-90 hover:scale-105 transition duration-700"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <span class="text-xs font-mono uppercase tracking-widest text-blue-400">Dossier Spécial</span>
                            <p class="text-sm font-semibold mt-1">Guide de migration des architectures monolithiques vers Docker Compose</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Liste des Articles -->
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between pb-6 mb-8 border-b border-slate-200">
                <h2 class="text-xl font-bold text-slate-900">
                    @if(request('search'))
                        Résultats de recherche pour "{{ request('search') }}"
                    @else
                        Publications récentes
                    @endif
                </h2>
                <span class="text-xs text-slate-500 font-medium">{{ $articles->total() }} article(s) disponible(s)</span>
            </div>

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-xl border border-slate-200/80 overflow-hidden hover:border-slate-300 transition-all duration-200 flex flex-col group shadow-sm hover:shadow-md">

                            <!-- Vignette Article -->
                            <div class="h-48 bg-slate-100 overflow-hidden relative border-b border-slate-100">
                                @if($article->images->isNotEmpty())
                                    <img
                                        src="{{ asset('storage/' . $article->images->first()->image_path) }}"
                                        alt="{{ $article->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    >
                                @else
                                    <img
                                        src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80"
                                        alt="Illustration technique"
                                        class="w-full h-full object-cover grayscale opacity-80 group-hover:scale-105 transition duration-500"
                                    >
                                @endif

                                @if($article->images->count() > 1)
                                    <span class="absolute bottom-3 right-3 bg-slate-900/80 text-white text-[10px] font-semibold px-2 py-1 rounded backdrop-blur-sm">
                                        {{ $article->images->count() }} visuels
                                    </span>
                                @endif
                            </div>

                            <!-- Contenu -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center justify-between text-xs font-medium text-slate-500 mb-3">
                                    <span class="text-blue-700 font-semibold">{{ $article->author }}</span>
                                    <time>{{ $article->created_at->format('d/m/Y') }}</time>
                                </div>

                                <h3 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                    <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                </h3>

                                <p class="text-slate-600 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                                    {{ Str::limit(strip_tags($article->content), 120) }}
                                </p>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('articles.show', $article) }}" class="text-xs font-semibold text-slate-900 group-hover:text-blue-600 transition flex items-center space-x-1">
                                        <span>Consulter l'article</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $articles->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-xl border border-slate-200 max-w-lg mx-auto">
                    <p class="text-slate-900 font-semibold mb-1">Aucune publication trouvée</p>
                    <p class="text-slate-500 text-sm mb-6">Ajustez les mots-clés recherchés ou créez une nouvelle entrée.</p>
                    <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-slate-900 text-white font-medium text-sm hover:bg-slate-800 transition">
                        Rédiger un article
                    </a>
                </div>
            @endif

        </div>
    </section>

@endsection
