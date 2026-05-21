@extends('layouts.esalle.app')

@section('content')

<div x-data="{ page: 'home' }" class="p-4">

    {{-- <!-- 🔘 Boutons -->
    <div class="flex gap-2 mb-4">
        <button @click="page = 'home'" class="px-4 py-2 bg-blue-500 text-white rounded">
            Accueil
        </button>

        <button @click="page = 'devoirs'" class="px-4 py-2 bg-green-500 text-white rounded">
            Devoirs
        </button>

        <button @click="page = 'activites'" class="px-4 py-2 bg-purple-500 text-white rounded">
            Activités
        </button>
    </div>

    <!-- 📦 CONTENU --> --}}

    <!-- HOME -->
    <div 
        x-show="page === 'home'" 
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-10"
    >
        <livewire:esalle.coursHoraire />
    </div>

    <!-- DEVOIRS -->
    {{-- <div 
        x-show="page === 'devoirs'" 
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-10"
    >
        <livewire:esalle.formulaire-devoir />
    </div> --}}



</div>

@endsection