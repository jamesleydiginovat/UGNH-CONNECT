@extends('layouts.app')

@section('topBarre')
    <livewire:inclus.top-barre />
@endsection

@section('main')

<div x-show="!tableSlideNote && !tableSlideNoteByStudent" @class([
    'm-3 p-3  bg-white rounded flex  flex-col  items-center justify-between',
    'lg:flex-row',
    'dark:border-gray-600 dark:border dark:bg-gray-900 '
])>
       <livewire:pages.notes-evaluation.count-notes />
 
</div>

<div 
    class=""
    x-show="!tableSlideNote && !tableSlideNoteByStudent"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-10" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.notes-evaluation.tableau-notes />
</div>

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
     
    <livewire:pages.notes-evaluation.tableau-notes-datail />
    
</div>



<div 
     x-show="tableSlideNoteByStudent"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.notes-evaluation.tableau-note-by-etudiant />
    
</div>


{{-- tableSlideNoteByStudent --}}

    <livewire:pages.notes-evaluation.formulaire-notes-evaluation />


@endsection















