@extends('layouts.app')

@section('title', 'DevBlog | Publications & Articles Techniques')

@section('content')

    <!-- Hero Slider Dynamique -->
    <section
        x-data="{
            activeSlide: 0,
            slides: [
                {
                    title: 'Conteneurisation & Orchestration d\'Applications Web',
                    description: 'Découvrez comment isoler vos environnements de développement et de production avec Docker et Docker Compose.',
                    image: 'https://images.unsplash.com/photo-1605745341112-85968b19335b?auto=format&fit=crop&w=1200&q=80'
                },
                {
                    title: 'Optimisation PostgreSQL et Full-Text Search',
                    description: 'Exploitez les fonctionnalités avancées de recherche vectorielle native pour des requêtes haute performance.',
                    image: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80'
                },
                {
                    title: 'Architectures Laravel & Pipelines CI/CD',
                    description: 'Automatisez vos phases de test et de déploiement continu pour maintenir un haut niveau de qualité logicielle.',
                    image: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&q=80'
                }
            ],
            next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
            prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
        }"
        x-init="setInterval(() => next(), 6000)"
        class="bg-slate-950 text-white relative overflow-hidden"
    >
        <!-- Arrière-plan Slider -->
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="activeSlide === index"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 z-0"
            >
                <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
            </div>
        </template>

        <!-- Contenu Slider -->
        <div class="max-w-7xl mx-auto px-6 py-20 lg:py-28 relative z-10 min-h-[420px] flex flex-col justify-between">
            <div class="max-w-2xl">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-500 delay-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight text-white mb-4" x-text="slide.title"></h1>
                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-8" x-text="slide.description"></p>
                    </div>
                </template>

                <!-- Barre de recherche intégrée -->
                <form action="{{ route('articles.index') }}" method="GET" class="max-w-xl">
                    <div class="flex items-center rounded-xl bg-slate-900/90 border border-slate-700 p-1.5 focus-within:border-blue-500 transition backdrop-blur-md shadow-2xl">
                        <svg class="w-5 h-5 text-slate-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher par sujet, technologie, auteur..."
                            class="w-full px-4 py-2.5 text-sm text-white placeholder-slate-400 bg-transparent focus:outline-none"
                        >
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm px-5 py-2.5 rounded-lg transition">
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contrôles du Slider -->
            <div class="flex items-center justify-between pt-12 border-t border-white/10 mt-8">
                <!-- Indicateurs -->
                <div class="flex space-x-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button
                            @click="activeSlide = index"
                            :class="activeSlide === index ? 'w-8 bg-blue-500' : 'w-2 bg-white/30 hover:bg-white/50'"
                            class="h-2 rounded-full transition-all duration-300"
                        ></button>
                    </template>
                </div>

                <!-- Flèches Précédent / Suivant -->
                <div class="flex space-x-2">
                    <button @click="prev()" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 backdrop-blur-md transition text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="next()" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 backdrop-blur-md transition text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Grille des Articles -->
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
