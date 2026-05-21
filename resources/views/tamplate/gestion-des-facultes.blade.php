@extends('layouts.app')

@section('topBarre')
    <livewire:inclus.top-barre />
@endsection

@section('main')
<div 
x-show="!tableSlideNote"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4"
@class([
    'm-3 p-3 bg-white rounded flex flex-col items-center justify-between',
    'lg:flex-row',
    // DARK MODE amélioré
    'dark:bg-gray-900 dark:border dark:border-gray-700'
])>

    <livewire:pages.count-faculte />
</div>

<livewire:pages.formulaire-faculte />




<div 
    class="h-full"
     x-show="tableSlideNote"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.pdf.documents />
    
</div>



<div 
    class="h-full"
     x-show="!tableSlideNote"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.tableau-faculte-et-decanats />
    
</div>

@endsection