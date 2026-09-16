@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        <!-- Ariane -->
        <a href="{{ route('articles.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition mb-8">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour aux articles
        </a>

        <!-- En-tête Article -->
        <header class="mb-8">
            <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                {{ $article->title }}
            </h1>

            <div class="flex items-center space-x-4 border-y border-slate-200/80 py-4">
                <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
                    {{ strtoupper(substr($article->author, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900">{{ $article->author }}</p>
                    <p class="text-xs text-slate-500">Publié le {{ $article->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </header>

        <!-- Galerie d'Images (Grille adaptative) -->
        @if($article->images->isNotEmpty())
            <div class="mb-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($article->images as $image)
                        <div class="rounded-2xl overflow-hidden bg-slate-100 border border-slate-200/80 shadow-sm h-64 sm:h-72">
                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover hover:scale-105 transition duration-500 cursor-pointer"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Texte de l'article -->
        <div class="prose prose-lg prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line font-normal text-base sm:text-lg mb-12">
            {{ $article->content }}
        </div>

        <!-- Zone d'action / Suppression -->
        <div class="border-t border-slate-200/80 pt-6 flex items-center justify-between">
            <a href="{{ route('articles.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">
                &larr; Tous les articles
            </a>

            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center text-sm font-semibold text-rose-600 hover:text-rose-800 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Supprimer l'article
                </button>
            </form>
        </div>
    </div>
@endsection
