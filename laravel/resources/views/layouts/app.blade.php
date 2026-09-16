<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Blog')</title>
    <!-- CDN Tailwind CSS pour un style moderne prêt à l'emploi -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- En-tête / Barre de Navigation -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ route('articles.index') }}" class="text-2xl font-bold text-blue-600 tracking-tight">
                DevBlog<span class="text-gray-400">.</span>
            </a>

            <nav class="flex items-center space-x-4">
                <a href="{{ route('articles.index') }}" class="text-gray-600 hover:text-blue-600 font-medium text-sm">
                    Tous les articles
                </a>
                <a href="{{ route('articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-lg transition shadow-sm">
                    + Publier un article
                </a>
            </nav>
        </div>
    </header>

    <!-- Notifications de succès -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex justify-between items-center text-sm">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 font-bold">&times;</button>
            </div>
        </div>
    @endif

    <!-- Contenu de la page -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Pied de page -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Mon Blog Laravel - Propulsé par Docker & PostgreSQL.
        </div>
    </footer>

</body>
</html>
