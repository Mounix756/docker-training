@extends('layouts.app')

@section('title', 'Publier un article - DevBlog')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">
    <!-- Bouton Retour -->
    <a href="{{ route('articles.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition mb-6">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Retour aux articles
    </a>

    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-sm">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
                Publier un nouvel article
            </h1>
            <p class="text-slate-500 text-sm">
                Remplissez les informations ci-dessous pour partager votre billet avec la communauté.
            </p>
        </div>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Titre -->
            <div>
                <label for="title" class="block text-sm font-bold text-slate-800 mb-2">Titre de l'article *</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Ex: Conteneuriser une application Laravel avec Docker et PostgreSQL"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition placeholder-slate-400 @error('title') border-rose-500 @enderror"
                >
                @error('title')
                    <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Auteur -->
            <div>
                <label for="author" class="block text-sm font-bold text-slate-800 mb-2">Nom de l'auteur *</label>
                <input
                    type="text"
                    name="author"
                    id="author"
                    value="{{ old('author') }}"
                    required
                    placeholder="Ex: Blaise Mouné"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition placeholder-slate-400 @error('author') border-rose-500 @enderror"
                >
                @error('author')
                    <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contenu -->
            <div>
                <label for="content" class="block text-sm font-bold text-slate-800 mb-2">Contenu de l'article *</label>
                <textarea
                    name="content"
                    id="content"
                    rows="8"
                    required
                    placeholder="Rédigez votre article ici..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition placeholder-slate-400 @error('content') border-rose-500 @enderror"
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Galerie d'Images -->
            <div>
                <label for="images" class="block text-sm font-bold text-slate-800 mb-1">Images de couverture (Optionnel, 4 max)</label>
                <p class="text-xs text-slate-500 mb-3">Formats acceptés : JPG, PNG, WEBP (Max: 2Mo par image).</p>

                <input
                    type="file"
                    name="images[]"
                    id="images"
                    multiple
                    accept="image/*"
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition cursor-pointer border border-slate-200 rounded-xl p-2"
                >
                @error('images')
                    <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-rose-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option Notification Newsletter -->
            <div class="pt-2">
                <label class="relative flex items-start p-4 rounded-2xl bg-slate-50 border border-slate-200/80 cursor-pointer hover:bg-slate-100/80 transition">
                    <div class="flex items-center h-5">
                        <input
                            type="checkbox"
                            name="notify_subscribers"
                            value="1"
                            {{ old('notify_subscribers') ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <span class="font-bold text-slate-900">Envoyer une notification aux abonnés</span>
                        <p class="text-slate-500 text-xs mt-0.5">Si cette option est cochée, un e-mail sera automatiquement envoyé à tous les abonnés actifs via Mailpit.</p>
                    </div>
                </label>
            </div>

            <!-- Actions -->
            <div class="pt-4 flex items-center justify-end space-x-4 border-t border-slate-100">
                <a href="{{ route('articles.index') }}" class="px-5 py-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-sm transition">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-md shadow-blue-500/20 transition hover:-translate-y-0.5">
                    Publier l'article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
