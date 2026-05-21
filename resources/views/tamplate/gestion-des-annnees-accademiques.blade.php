@extends('layouts.app')

@section('topBarre')
    <livewire:inclus.top-barre />
@endsection

@section('main')

<div @class([
    'm-3 p-3 bg-white rounded flex  flex-col  items-center justify-between',
    'lg:flex-row',
    'dark:border-gray-600 dark:border dark:bg-gray-900'
])>
        <div @class([
            'flex flex-col justify-between gap-3 w-full',
            'sm:flex-row  '
        ])>
                <div class=" flex flex-row gap-3">
                {{-- <div @class([
                    'p-3 rounded gap-4  flex flex-row items-center justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700  '
                ])>
                    <div @class(['flex flex-col gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row gap-2 text-nowrap ',
                            'dark:text-gray-300'
                        
                        ])> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Total cours
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-300'
                            ])>
                            504</p>
                    </div>



                    <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600  rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce p-1 rounded'])>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>
                            

                            <select @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ]) name="" id="">
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Faculte</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Informatique</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Infirmiere</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Biomedicale</option>
                            </select>
                        </div>
            
                </div> --}}

                </div>

                

    </div>




<div @class([
    'flex flex-col justify-between gap-1 ps-0 pt-5 w-full',
    'lg:w-1/2 lg:justify-end lg:ps-5 lg:pt-0'
])>

    {{-- <div @class([
        'flex flex-row gap-1 justify-between'
    ])>
        <!-- Imprimer -->
        <button @class([
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

            Ajouter un evenement
        </button>

    </div> --}}

    <!-- Enregistrer paiement -->
    <button 
        @click="form = !form"
        @class([
            'flex flex-row p-2 rounded gap-2 transition-all duration-300',
            'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
            // DARK MODE (uniformisé comme demandé)
            'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
        ])
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        Ajouter une annee academique
    </button>

</div>
</div>

<livewire:pages.annee-accademique.annee-accademique />

<livewire:pages.annee-accademique.formulaire-annee-accademique />


@endsection