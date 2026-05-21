<section class="dark:text-gray-50">

    <style>
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        font-family: 'Times New Roman', Times, serif;
    }
    .page-break {
        page-break-after: always;
    }
    </style>


    <div class=" right-0 top-0 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 mx-3'])
            
            >
                <svg x-show="pdf"  @click="pdf = !pdf" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-ugnh-blueFonce hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <div x-show="!pdf" ></div>


                <svg @click="tableSlideNote = !tableSlideNote" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg> 
        </div>
    </div>

    <div 
        class="h-full"
        x-show="!pdf"
        x-cloak
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        {{-- x-transition:leave="transition ease-in duration-500" --}}
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4">

                <div  class="absolute  flex flex-col gap-3 bottom-2 right-2">
                
                <button 
                    @click="progressBar = true"
                    wire:click="export" class="flex flex-row gap-2 bg-ugnh-blueFonce  text-gray-50 p-2 rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Exporter
                </button>

                <button wire:click="isFullInformation" @click="fullInformation = !fullInformation" class="flex flex-row gap-2 bg-ugnh-blueFonce p-2 text-gray-50 rounded-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Toute les Informations
                </button>
            </div>



            <section x-data="{ open: true }" class="mx-3 mb-2 pb-1 shadow-2xl ">

                <!-- Bouton SVG -->
                <div @click="open = !open" class="cursor-pointer  flex flex-row gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
                    </svg>
                    Filtre
                </div>

                <!-- Contenu à afficher -->
                <div 
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4"
                    class="mt-2 flex felx-row justify-between"
                >
                
                    <div class="flex flex-row gap-3">
                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce text-gray-50 p-1 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Sexe: 
                            </div>
                            

                            <select  wire:model.live="sexe" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Sexe</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="M">M</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="F">F</option>
                                {{-- <option class="dark:text-ugnh-blueFonce" value="">...</option> --}}
                            </select>
                        </div>



                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce text-gray-50  p-1 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Status:
                            </div>
                            

                            <select  wire:model.live="status" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Etudiant">Etudiant</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Postulant">Postulant</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Expulsé">Expulsé</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Gradué">Gradué</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Abandonner">Abandonner</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Supprimer">Supprimer</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="Suspendu">Suspendu</option>
                                
                            </select>
                        </div>



                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce text-gray-50  p-1 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Faculte:
                            </div>
                            

                            <select  wire:model.live="faculte" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                @foreach ($this->Facultes as $faculte)
                                    <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce text-gray-50  p-1 rounded'])>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg> --}}
                                Niveau:
                            </div>
                            

                            <select  wire:model.live="niveau" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="3">III</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="4">IV</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="5">V</option>
                            </select>
                        </div>
                    </div>



                    <div class="flex flex-row gap-3 ">
                        {{-- <button  @click="modalConfirmation = !modalConfirmation" class="bg-ugnh-blueFonce p-2 cursor-pointer hover:scale-110 transition-all ease-in-out duration-200 rounded-sm">Dossier personnels</button> --}}
                        {{-- <button wire:click="putValue" class="bg-ugnh-blueFonce p-2 cursor-pointer hover:scale-110 transition-all ease-in-out duration-200 rounded-sm">Les personnels utilisateurs</button> --}}
                    </div>
                </div>

            </section>



            
            <section class="flex flex-col gap-2 w-full">

                <div class="page  bg-white text-black mx-auto">
                    <section class="flex flex-row  items-center border-b border-black pb-2">
                        <div>
                            <img class="min-w-20 h-20 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                        </div>

                        <div class="w-full text-center">
                            <h1 class="text-2xl font-bold">UNGH</h1>
                            <h1 class="text-2xl font-bold">Universite du Grand Nord d'Haiti</h1>
                            <h2 class="text-lg">La science au service du developpement</h2>
                            <h3>142, rue 7A, HT1110 - Cap-Haitien, Haiti</h3>
                        </div>

                        <div>
                            <img class="min-w-20 h-20 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                        </div>

                    </section>


                    <section class="text-xl uppercase font-bold text-center mt-5 underline">
                        <h1>{{ $this->Titre }}</h1>
                    </section>


                    <section style="margin-top: 20px;">

                                        

                        @if ($this->matricule =="")
                            
                                @if ($this->ListeEtudiants->isEmpty())
                                    <p>Aucun!</p>
                                @else
                                    <table x-show="!fullInformation" style="border: solid 1px; " width="100%" cellspacing="0" cellpadding="5">
                                        <thead >
                                            <tr style="border: solid 1px; background-color: rgb(24, 51, 160); color:white;">
                                                <th style="border: solid 1px; padding: 3px; width: 100px;">Matricule</th>
                                                <th style="border: solid 1px; padding: 3px;">Nom complet</th>
                                                <th style="border: solid 1px; padding: 3px;">Email</th>
                                                <th style="border: solid 1px; padding: 3px;">Niveau</th>
                                                <th style="border: solid 1px; padding: 3px;">Faculte</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($this->ListeEtudiants as $etudiant )
                                            <tr style="border: solid 1px;">
                                                
                                                <td style="border: solid 1px; padding: 3px;">{{ $etudiant->matricule }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $etudiant->nom." ".$etudiant->prenom }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $etudiant->email }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $etudiant->niveau }}</td>
                                                <td style="border: solid 1px; padding: 3px;">{{ $etudiant->faculte->first()?->nom ?? ''  }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                    <table x-show="fullInformation" width="100%" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            @foreach ($this->ListeEtudiants as $etudiant )
                                            <tr class="bg-blue-100">
                                                <td></td>
                                                <td class="text-end font-bold" style="padding: 3px;">{{ $etudiant->nom." ".$etudiant->prenom }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Code</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->matricule }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Nom</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->nom }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Prenom</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->prenom }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Sexe</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->sexe }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Email</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->email }}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Adresse</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->adresse }}</td>
                                            </tr>


                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Telephone</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->telephone }}</td>
                                            </tr>

                                            {{-- <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Fonction</td>
                                                <td class="text-left" style="padding: 3px;">{{ $personnel->fonction }}</td>
                                            </tr> --}}

                                            <tr>
                                                <td class="font-bold text-left" style="padding: 3px;">Condition matrimoniale</td>
                                                <td class="text-left" style="padding: 3px;">{{ $etudiant->conditionMatrimoniale }}</td>
                                            </tr>

                                        


                                            @endforeach
                                        </tbody>
                                    </table>

                                @endif
                        @else

                            <table width="100%" cellspacing="0" cellpadding="5">
                                <tbody>
                                    @foreach ($this->ListeEtudiants as $etudiant )
                                    <tr class="bg-blue-100">
                                        <td class="font-bold text-left" style="padding: 3px;">STATUS</td>
                                        <td class="text-end" style="padding: 3px;">{{ $etudiant->status }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Code</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->matricule }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Nom</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->nom }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Prenom</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->prenom }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Sexe</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->sexe }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Email</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->email }}</td>
                                    </tr>

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Adresse</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->adresse }}</td>
                                    </tr>


                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Telephone</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->telephone }}</td>
                                    </tr>

                                    {{-- <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Fonction</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->fonction }}</td>
                                    </tr> --}}

                                    <tr>
                                        <td class="font-bold text-left" style="padding: 3px;">Condition matrimoniale</td>
                                        <td class="text-left" style="padding: 3px;">{{ $etudiant->conditionMatrimoniale }}</td>
                                    </tr>

                                


                                    @endforeach
                                </tbody>
                            </table>
                            
                        @endif

                    
                        
                    </section>
                </div>

                {{-- <div class="page page-break bg-white text-black mx-auto">
                    <h1 class="text-xl font-bold">Page 2</h1>
                </div> --}}

            </section>

    </div>



    <div 
    class="h-full"
     x-on:success-pdf.window="pdf = !pdf"
     x-show="pdf"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
     <section class="mx-3 h-screen">
        {{-- @include('livewire.pages.pdf.iframes.pdf-personnel') --}}
        <livewire:pages.pdf.iframes.pdf-etudiants />
    </section>
    
    </div>


    





    {{-- modal confirmation  --}}
     <section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
    ])
    x-show="modalConfirmation"
    x-transition.duration.300ms
    >



    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-30 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white relative rounded-lg p-5 dark:bg-gray-800 lg:min-w-[40%]  sm:min-w-[50%] sm:w-auto w-[93%]  h-auto  shadow-2xl overflow-y-auto ">
         
            <div @class(['absolute z-50 top-0 right-0   cursor-pointer  rounded-tr-lg p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            @click="modalConfirmation = !modalConfirmation"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            
            <div class="flex sm:flex-row  flex-col">
                <div class="relative w-full sm:w-20  ">
                    <div class=" sm:bg-yellow-200 sm:absolute flex justify-center sm:p-2 rounded-full top-0 left-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-center text-yellow-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </div>
                </div>

                <div class="w-full">
                    <h1 class="font-bold ">Entrez le code du personnel</h1>
                    {{-- <p>Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.</p> --}}
                    <input wire:model="codePersonnel" class="p-3 rounded-lg border border-gray-400 w-full" type="text" name="" id="">
                    <div class=" mt-5 flex fle-col gap-3 sm:justify-end justify-between">
                        {{-- <button wire:click="deletePersonnel({{ $personnelSelectionner }})"  @click="modalConfirmation = !modalConfirmation" class="bg-red-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-red-400">Supprimer</button> --}}
                        <button wire:click="putCodePersonnel"  @click="modalConfirmation = !modalConfirmation"  class="bg-gray-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-gray-400">Valider</button>
                    </div>
                </div>
             </div>
        </div>

    </div>
    
</section>    

<div 
    x-show="progressBar"
    x-transition

    x-effect="
        if (progressBar) {
            progress = 0;

            clearInterval(interval);

            interval = setInterval(() => {
                if (progress >= 100) {
                    clearInterval(interval);
                    setTimeout(() => progressBar = false, 100);
                } else {
                    progress += 10;
                }
            }, 100);
        }
    "

    class="flex flex-col gap-4 bg-white dark:bg-gray-700 shadow-2xl rounded-2xl p-5 
           absolute z-50 top-[45%] md:left-[30%] left-[10%] md:right-[30%] right-[10%]"
>

    <!-- TEXTE -->
    <h2 class="text-lg font-bold text-center text-gray-800 dark:text-white">
        Téléchargement en cours...
    </h2>

    <!-- BARRE -->
    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
        <div 
            class="bg-blue-600 h-4 transition-all duration-100"
            :style="'width: ' + progress + '%'"
        ></div>
    </div>

    <!-- POURCENTAGE -->
    <p class="text-center text-sm text-gray-600 dark:text-gray-300">
        <span x-text="progress"></span>%
    </p>

</div>

</section>
