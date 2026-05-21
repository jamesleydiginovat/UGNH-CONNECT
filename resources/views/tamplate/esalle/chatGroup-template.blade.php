@extends('layouts.esalle.app')

@section('content')

<div x-data="{ page: 'home' }" >

    <div 
        x-show="page === 'home'" 
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-10"
    >
        <livewire:esalle.chat-group />
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