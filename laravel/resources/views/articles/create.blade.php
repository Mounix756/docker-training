@extends('layouts.app')

@section('title', 'Publier un nouvel article')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Nouveau Billet de Blog</h1>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Titre -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'article *</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Ex: Découvrir la conteneurisation avec Docker"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900"
                >
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Auteur -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Nom de l'auteur *</label>
                <input
                    type="text"
                    name="author"
                    id="author"
                    value="{{ old('author') }}"
                    required
                    placeholder="Ex: Jean Dupont"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900"
                >
                @error('author')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contenu -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu de l'article *</label>
                <textarea
                    name="content"
                    id="content"
                    rows="6"
                    required
                    placeholder="Rédigez le corps de votre article ici..."
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900"
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Galerie d'images (Max 4) -->
            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Images d'illustration (4 maximum)</label>
                <input
                    type="file"
                    name="images[]"
                    id="images"
                    multiple
                    accept="image/png, image/jpeg, image/jpg, image/webp"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"
                >
                <p class="text-xs text-gray-400 mt-1">Format accepté : JPG, PNG, WEBP (Max 2 Mo par fichier).</p>
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option Notification Mail -->
            <div class="pt-2 border-t border-gray-100">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input
                        type="checkbox"
                        name="notify_subscribers"
                        value="1"
                        {{ old('notify_subscribers') ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    >
                    <span class="text-sm text-gray-700">Notifier les abonnés à la newsletter par e-mail</span>
                </label>
            </div>

            <!-- Boutons de soumission -->
            <div class="flex items-center justify-end space-x-3 pt-4">
                <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition shadow-sm">
                    Publier l'article
                </button>
            </div>
        </form>
    </div>
@endsection
