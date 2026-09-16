@extends('layouts.app')

@section('title', 'DevBlog | Liste des abonnés')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- En-tête de section -->
    <div class="flex items-center justify-between pb-6 mb-8 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Abonnés à la Newsletter</h1>
            <p class="text-sm text-slate-500 mt-1">Liste complète des adresses e-mail inscrites aux notifications.</p>
        </div>
        <span class="text-xs text-slate-600 font-semibold px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200">
            {{ $subscribers->total() }} abonné(s) au total
        </span>
    </div>

    <!-- Tableau des abonnés -->
    @if($subscribers->count() > 0)
        <div class="bg-white rounded-xl border border-slate-200/80 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Adresse E-mail</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4">Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($subscribers as $subscriber)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $subscriber->id }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $subscriber->email }}</td>
                                <td class="px-6 py-4">
                                    @if($subscriber->is_active)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs">
                                    {{ $subscriber->created_at->format('d/m/Y à H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $subscribers->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-xl border border-slate-200 max-w-lg mx-auto">
            <p class="text-slate-900 font-semibold mb-1">Aucun abonné pour le moment</p>
            <p class="text-slate-500 text-sm">Les adresses enregistrées s'afficheront ici automatiquement lors des inscriptions.</p>
        </div>
    @endif
</div>
@endsection
