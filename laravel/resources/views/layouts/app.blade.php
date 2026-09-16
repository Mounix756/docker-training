<!DOCTYPE html>
<html lang="fr" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevBlog | Ingénierie & Architecture Web')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body x-data="{ searchOpen: false }" class="flex flex-col min-h-full text-slate-900 antialiased selection:bg-slate-900 selection:text-white">

    <!-- En-tête de navigation -->
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-8">
                <a href="{{ route('articles.index') }}" class="flex items-center space-x-3">
                    <span class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center font-bold text-sm">D</span>
                    <span class="text-base font-bold tracking-tight text-slate-900">DevBlog<span class="text-blue-600">.</span></span>
                </a>
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('articles.index') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Articles</a>
                    <a href="#newsletter" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Newsletter</a>
                </nav>
            </div>

            <!-- Actions droite : Recherche rapide + Publier -->
            <div class="flex items-center space-x-3">
                <button
                    @click="searchOpen = !searchOpen"
                    type="button"
                    class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition focus:outline-none"
                    title="Rechercher un article"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 transition shadow-sm">
                    Publier un article
                </a>
            </div>
        </div>

        <!-- Panneau de recherche rétractable -->
        <div x-show="searchOpen" x-collapse x-cloak class="bg-slate-100 border-b border-slate-200 py-3 px-6">
            <div class="max-w-3xl mx-auto">
                <form action="{{ route('articles.index') }}" method="GET" class="flex items-center space-x-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par titre, auteur ou mots-clés..."
                        class="w-full px-4 py-2 text-sm rounded-lg border border-slate-300 bg-white focus:outline-none focus:border-slate-900"
                    >
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-lg text-sm font-medium hover:bg-slate-800 transition">
                        Rechercher
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Messages Flash -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-slate-900 text-white px-4 py-3 rounded-xl flex items-center justify-between text-sm shadow-md">
                <p>{{ session('success') }}</p>
                <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-white ml-4 font-semibold">Fermer</button>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Section Newsletter -->
    <section id="newsletter" class="bg-slate-900 text-white py-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7">
                    <span class="text-xs font-semibold uppercase tracking-wider text-blue-400">Veille Technologique</span>
                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight mt-2 mb-3">Recevez nos publications d'ingénierie</h2>
                    <p class="text-slate-400 text-sm max-w-xl leading-relaxed">
                        Un récapitulatif hebdomadaire axé sur le développement backend, les architectures distribuées et la conteneurisation.
                    </p>
                </div>
                <div class="lg:col-span-5">
                    <form action="{{ route('subscribers.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                        @csrf
                        <input
                            type="email"
                            name="email"
                            required
                            placeholder="adresse.email@domaine.com"
                            class="w-full px-4 py-3 rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-blue-500 transition"
                        >
                        <button type="submit" class="px-5 py-3 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-medium text-sm whitespace-nowrap transition">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer class="bg-slate-950 text-slate-500 py-10 border-t border-slate-900 text-xs">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; {{ date('Y') }} DevBlog. Édition technique sous licence MIT.</p>
            <div class="flex space-x-6">
                <a href="{{ route('articles.index') }}" class="hover:text-slate-300 transition">Accueil</a>
                <a href="#newsletter" class="hover:text-slate-300 transition">Newsletter</a>
            </div>
        </div>
    </footer>

</body>
</html>
