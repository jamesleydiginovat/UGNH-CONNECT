@extends('layouts.app')

@section('topBarre')
    <livewire:inclus.top-barre />
@endsection

@section('main')
<div
     x-show="!tableSlideNote && !historiqueTransaction && !ficheTransaction  && !tarifFaculte"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
    

<div @class([
    'm-3 p-3 bg-white rounded flex  flex-col  items-center justify-between',
    'lg:flex-row',
    'dark:border-gray-600 dark:border dark:bg-gray-900'
])>
    <livewire:pages.finances.count-paiement-etudiants />

    <div @class([
        'flex flex-col justify-between gap-1 ps-0 pt-5 w-full',
        'lg:w-1/2 lg:justify-end lg:ps-5 lg:pt-0 '
    ])>

        <div @class([
            'flex flex-row gap-1 justify-between'
        ])>

            <!-- Exporter -->
            {{-- <button @class([
                'flex flex-row w-1/2 p-2 rounded gap-2 transition-all duration-300',
                'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
                // DARK MODE
                'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
            ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>

                Exporter
            </button> --}}

            <!-- Imprimer -->
            <button @click="ficheTransaction = !ficheTransaction"  @class([
                'flex flex-row w-full p-2 rounded gap-2 transition-all duration-300',
                'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
                // DARK MODE
                'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
            ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                </svg>

                Documents
            </button>

        </div>

        <!-- Enregistrer paiement -->
        <button 
            @click="form = !form"
            @class([
                'flex flex-row p-2 rounded gap-2 transition-all duration-300',
                'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
                // DARK MODE
                'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
            ])
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15" />
            </svg>

            Enregistrer un paiement
        </button>

        <!-- Info -->
        {{-- <p class="p-1 bg-ugnh-blueClair dark:bg-gray-800 dark:text-gray-300 rounded">
           
        </p> --}}

    </div>
</div>

<livewire:pages.finances.tableau-paiements />

</div>

<div class="h-full"
     x-show="tableSlideNote"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.finances.details-page />
    
</div>


<div class="h-full"
     x-show="historiqueTransaction"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.finances.historique-transaction />
    
</div>


<div class="h-full"
     x-show="ficheTransaction"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.fiche-transaction />
    
</div>


<div class="h-full"
     x-show="tarifFaculte"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
    <livewire:pages.tarif-faculte />
    
</div>


 {{-- @click="tableSlideNote = !tableSlideNote" --}}
{{-- historiqueTransaction --}}

<livewire:pages.finances.formulaire-paiement-etudiants />


@endsection

