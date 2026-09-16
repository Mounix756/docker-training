<!DOCTYPE html>
<html lang="fr" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevBlog - Actualités & Tutos')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="flex flex-col min-h-full text-slate-800 antialiased selection:bg-blue-500 selection:text-white">

    <!-- En-tête Sticky -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('articles.index') }}" class="flex items-center space-x-2 group">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-extrabold text-xl shadow-md shadow-blue-500/20 group-hover:scale-105 transition">
                    B
                </div>
                <span class="text-xl font-bold text-slate-900 tracking-tight">DevBlog<span class="text-blue-600">.</span></span>
            </a>

            <nav class="flex items-center space-x-6">
                <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">Articles</a>
                <a href="#newsletter" class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition hidden sm:inline-block">Newsletter</a>
                <a href="{{ route('articles.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-500/20 transition hover:-translate-y-0.5">
                    + Écrire un article
                </a>
            </nav>
        </div>
    </header>

    <!-- Alertes Notifications -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-emerald-50 border border-emerald-200/80 text-emerald-900 px-4 py-3.5 rounded-2xl flex items-center justify-between text-sm shadow-sm">
                <div class="flex items-center space-x-3">
                    <span class="flex-shrink-0 w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 font-bold text-lg">&times;</button>
            </div>
        </div>
    @endif

    @if($errors->has('email'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-rose-50 border border-rose-200/80 text-rose-900 px-4 py-3.5 rounded-2xl flex items-center justify-between text-sm shadow-sm">
                <span>{{ $errors->first('email') }}</span>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 font-bold text-lg">&times;</button>
            </div>
        </div>
    @endif

    <!-- Contenu Principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Section Newsletter Globale -->
    <section id="newsletter" class="bg-slate-900 text-white py-16 mt-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <span class="inline-block bg-blue-500/10 text-blue-400 font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wider mb-4 border border-blue-500/20">
                Restez Informé
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Abonnez-vous à notre newsletter</h2>
            <p class="text-slate-400 max-w-xl mx-auto mb-8 text-sm sm:text-base leading-relaxed">
                Recevez directement dans votre boîte mail nos meilleurs articles dès leur publication. Pas de spam, désabonnement en un clic.
            </p>

            <form action="{{ route('subscribers.store') }}" method="POST" class="max-w-md mx-auto flex flex-col sm:flex-row gap-3">
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Entrez votre adresse e-mail..."
                    class="w-full px-4 py-3.5 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                >
                <button type="submit" class="sm:w-auto px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm transition shadow-lg shadow-blue-600/30 whitespace-nowrap">
                    S'abonner
                </button>
            </form>
        </div>
    </section>

    <!-- Pied de Page -->
    <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-sm">B</div>
                <span class="text-lg font-bold text-white tracking-tight">DevBlog</span>
            </div>
            <p class="text-xs text-slate-500">&copy; {{ date('Y') }} DevBlog Inc. Conçu avec Laravel, PostgreSQL & Docker.</p>
        </div>
    </footer>

</body>
</html>
