@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <article class="max-w-3xl mx-auto bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <!-- Fil d'ariane -->
        <a href="{{ route('articles.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">&larr; Retour à tous les articles</a>

        <!-- En-tête Article -->
        <header class="mb-6 border-b border-gray-100 pb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-3">{{ $article->title }}</h1>
            <div class="flex items-center text-sm text-gray-500 space-x-4">
                <span>Rédigé par <strong class="text-gray-800">{{ $article->author }}</strong></span>
                <span>&bull;</span>
                <time>{{ $article->created_at->translatedFormat('d F Y à H:i') }}</time>
            </div>
        </header>

        <!-- Galerie d'images -->
        @if($article->images->isNotEmpty())
            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Galerie d'images ({{ $article->images->count() }})</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($article->images as $image)
                        <div class="h-56 bg-gray-100 rounded-xl overflow-hidden border border-gray-200">
                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover hover:scale-105 transition duration-300"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Corps du texte -->
        <div class="prose prose-blue max-w-none text-gray-800 leading-relaxed whitespace-pre-line text-base mb-8">
            {{ $article->content }}
        </div>

        <!-- Actions (Suppression) -->
        <div class="pt-6 border-t border-gray-100 flex items-center justify-between">
            <a href="{{ route('articles.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                &larr; Retour
            </a>

            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                    Supprimer l'article
                </button>
            </form>
        </div>
    </article>
@endsection
