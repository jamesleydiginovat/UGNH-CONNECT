
<section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
])
x-show="form"
x-transition.duration.300ms

>

        <div
                x-on:success-pdffiche.window="pdf = !pdf"
                x-show="pdf"
                x-cloak
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 transform translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                {{-- x-transition:leave="transition ease-in duration-500" --}}
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform translate-y-4"
            @class([
                'relative h-full '
            ])>


            <section @class([
            'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-70 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
            ])> 
            </section>

                
            <section class="mx-3 h-screen">
                <div @class(['absolute z-50 sm:top-3  top-3  right-1 cursor-pointer p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
                    @click="pdf = !pdf"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

                {{-- @include('livewire.pages.pdf.iframes.pdf-personnel') --}}
                <livewire:pages.pdf.iframes.pdf-recu-paiement />
            </section>
        </div>


    <div
        x-show="!pdf"
        x-cloak
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        {{-- x-transition:leave="transition ease-in duration-500" --}}
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4"
    @class([
        'relative h-full '
    ])>
    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-20 dark:opacity-80 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white dark:border-5 dark:border-gray-600 relative dark:bg-gray-800 lg:w-[60%]  sm:w-[80%] w-full sm:h-[95%] no-scrollbar h-full rounded-lg shadow-2xl overflow-y-auto ">
            
            {{-- <div @class(['absolute z-50 sm:top-0 top-5 right-0   cursor-pointer  p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            @click="form = !form"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div> --}}


            <div @class(['fixed sm:absolute sm:top-1  z-50 sm:top-0 top-1 right-1 sm:right-0 bg-red-500 sm:bg-transparent  cursor-pointer  p-1 sm:text-red-500 text-gray-50 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            wire:click="resetForm"
            @click="form = !form"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            
            
            <div class="sm:text-2xl z-20 text-normal sm:relative fixed w-full top-0 left-0  font-bold p-3 text-center bg-ugnh-blueClair sm:rounded-t-sm rounded-none dark:text-gray-600">
               Enregistrer un paiement
            </div>
           <form wire:submit="save" 
            @class(['flex flex-col gap-5  overflow-y-scroll no-scrollbar overflow-x-hidden sm:mt-0 mt-15',
                    'dark:text-gray-400'
            ])
            >

        
            {{-- <div class="sm:w-24 w-10 sm:h-24 h-10 rounded-full overflow-hidden bg-ugnh-blueFonce absolute sm:top-4 top-7  right-auto left-1 sm:left-[47%] border  border-gray-300 dark:border-gray-700">
                <img
                    src="{{ asset('images/406659423c8827afe36441daaee8d9b2.jpg') }}"
                    alt=""
                    class="w-full h-full  object-cover text-center "
                >
            </div> --}}



            <div class="flex flex-col gap-5 border border-gray-200 shadow-sm p-6 dark:border-gray-600">
            
                        {{-- <div class="flex flex-col gap-5 border border-gray-200 shadow-sm p-6 dark:border-gray-600">
                            <div @class(['flex sm:flex-row flex-col gap-5 '])>
                                <div class=" w-full flex flex-row">
                                    <label class="font-bold text-gray-500 " for="date">Date:</label>
                                    <input @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="date" id="date" >
                                </div>
                               {{-- <div class="sm:w-1/2 w-full flex flex-row ">
                                    <label class="font-bold text-gray-500"  for="numFiche">No:</label>
                                    <input @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="numFiche" >
                               </div> --}}
                            {{-- </div> --}} 
                <input wire:model.live="codePersonnel" type="text" class="border border-gray-200" hidden>
                {{-- <div class="flex flex-row items-center relative">
                    <input wire:model.live="rechercherEtudiant" class="border pe-10 border-ugnh-blueClair shadow-sm rounded-lg p-2 w-full outline-none" type="text" name="" id="" placeholder="Rechercher l'etudiant" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 absolute cursor-pointer hover:bg-ugnh-blueHover bg-ugnh-blueFonce text-white p-1 rounded-lg top-2 right-2 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div> --}}

                <div>
                    <div class=" w-full flex flex-row">
                        <label class="font-bold text-gray-500"  for="faculte">Annee academique:</label>
                        <div class="relative w-[70%]  pb-4">
                        <select
                            wire:model.live="anneAcademiqueSelect" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('anneAcademiqueSelect')]) name="" id="faculte">
                            <option value=""></option>
                            @foreach ($this->LesAnneeAcademiques as $faculte)
                                <option class="dark:text-ugnh-blueFonce" value="{{ $faculte->libelle }}">{{ $faculte->libelle }}</option>
                            @endforeach
                            
                        </select>
                        @error('anneAcademiqueSelect') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>


                <div class="flex flex-row justify-between items-center w-full">
                <div class="sm:w-1/2 w-full flex flex-row">
                    <label class="font-bold text-gray-500"  for="faculte">Faculte:</label>
                    <div class="relative w-auto  pb-4">
                    <select
                        wire:model.live="codeFacSelect" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('codeFacSelect')]) name="" id="faculte">
                        <option value=""></option>
                        @foreach ($this->Facultes as $faculte)
                            <option class="dark:text-ugnh-blueFonce" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                        @endforeach
                        
                    </select>
                    @error('codeFacSelect') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>

                </div>



                <div class="sm:w-1/2 w-full flex flex-row">
                    <label class="font-bold text-gray-500"  for="faculte">Niveau:</label>
                    <div class="relative w-auto  pb-4">
                    <select
                        wire:model.live="niveauSelect" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('niveauSelect')]) name="" id="faculte">
                        <option value=""></option>
                            <option class="dark:text-ugnh-blueFonce" value="1">Niveau I</option>
                            <option class="dark:text-ugnh-blueFonce" value="2">Niveau II</option>
                            <option class="dark:text-ugnh-blueFonce" value="3">Niveau III</option>
                            <option class="dark:text-ugnh-blueFonce" value="4">Niveau IV</option>
                            <option class="dark:text-ugnh-blueFonce" value="5">Niveau V</option>
                            <option class="dark:text-ugnh-blueFonce" value="6">Niveau VI</option>

                        
                    </select>
                    @error('niveauSelect') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>
                </div>
                </div>
                

                <div class=" flex flex-row">
                    <label class="font-bold text-gray-500"  for="sexe">
                        Etudiant
                    </label>
                    <div class="relative w-[90%]  pb-4">
                    {{-- <input wire:model.live="email" @class(['outline-0 border-b border-gray-600 mx-3 sm:w-[80%] w-full','border-red-600'=>$errors->has('email')]) type="email" id="email" > --}}
                    <select
                    @readonly(true)
                    wire:model.live="matriculeEtudiant"
                    wire:click="remplirForm"
                    @class(['outline-0 border-b border-gray-600 mx-3  w-full dark:text-ugnh-blueClair dark:border-gray-600','border-red-600'=>$errors->has('matriculeEtudiant')])
                    name="" id="sexe">
                        {{-- <option value=""></option> --}}
                        @if ($rechercherEtudiant)
                            @foreach ($this->EtudiantSelect as $etudiant )
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="{{$etudiant->matricule}}">{{$etudiant->nom}}</option>
                            @endforeach
                        @endif

                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Choisir l'etudiant</option>
                        @foreach ($this->Etudiants as $etudiant)
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $etudiant->matricule }}">{{ $etudiant->matricule.": ".$etudiant->nom." ".$etudiant->prenom }}</option>
                        @endforeach 
                    </select>
                    @error('matriculeEtudiant') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>
                    
                </div>


                                {{-- <div class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="email">E-mail:</label>
                
                </div> --}}

                <input hidden type="text"  wire:model.live="niveau">

                <div hidden class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="codeFaculte">Faculte:</label>
                <div class="relative w-[80%]  pb-4">
                <input wire:model.live="nomFac" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('codeFaculte')]) type="text" id="codeFaculte"@readonly(true) >
                <input hidden wire:model.live="codeFaculte" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('codeFaculte')]) type="text" id="codeFaculte"@readonly(true) >
                @error('codeFaculte') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>
                </div>
            </div>





            <div @class([
                'flex flex-col gap-5 border border-gray-200 shadow-sm p-6',
                'dark:border-gray-600 h-auto overflow-hidden'
            ])>
            


            {{-- <div @class(['flex sm:flex-row flex-col gap-5 '])> --}}
                <div>
                    {{-- <input class="text-end font-bold">Lun 9 mars</input> --}}
                    <input @readonly(true) class="text-end w-full font-bold outline-none " wire:model="dateTransaction" type="text">
                </div>

                <div class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="numTransaction">Numero Transaction:</label>
                <div class="relative w-[80%]  pb-4">
                <input wire:model.live="numTransaction" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('numTransaction')]) type="text" id="numTransaction"@readonly(true) >
                @error('numTransaction') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>
                </div>


                <div class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="motif">Motif:</label>

                <div class="relative w-[90%]  pb-4">
                <input wire:model.live="motifPaiement" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('fonction')]) type="text" id="motifPaiement" @readonly(true)  placeholder="Le système effectuera cette opération automatiquement.">
                 @error('motifPaiement') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>

                </div>

                
            {{-- </div> --}}

            {{-- <div @class(['flex sm:flex-row flex-col gap-5 '])> --}}

            <div class=" flex flex-row">
                <label class="font-bold text-gray-500"  for="modePaiement">Mode de paiement:</label>
                <div class="relative w-[75%]  pb-4">
                <select wire:model.live="modePaiement" @class([
                'outline-0 border-b border-gray-600 mx-3',
                'dark:text-ugnh-blueClair dark:border-gray-600',
                'border-red-600'=>$errors->has('modePaiement')
                ]) name="" id="modePaiement">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value=""></option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="Espece">Espece</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="MonCash">MonCash</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="NatCash">NatCash</option>
                    
                </select>
                @error('modePaiement') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- </div> --}}


            <div class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="montant">Montant:</label>

                <div class="relative  pb-4">
                <div class="relative w-full">
                    {{-- <div class="absolute top-0 right-0  flex flex-row items-center bg-red-500 p-2 h-full">
                        <p>Gourdes</p>
                    </div> --}}
                    <input wire:model.live="montant" @class(['outline-0 border border-ugnh-blueFonce w-full p-2 rounded-sm bg-ugnh-blueClair dark:bg-gray-700 dark:border-yellow-500  mx-3', 'border-red-600'=>$errors->has('montant')]) type="text" id="motifPaiement" @readonly(false) >
                </div>
                 @error('montant') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>

            </div>


            </div>






            <div @class([
                'flex flex-row justify-between gap-5 border border-gray-200 shadow p-6',
                'dark:border-gray-600'
            ])>

                <button
                
                @class([
                'hover:bg-ugnh-blueHover hover:text-ugnh-blueClair flex flex-row bg-ugnh-blueFonce text-gray-50 dark:text-gray-300 dark:border dark:border-gray-600 p-2 rounded gap-2'
            ])
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Enregistrer
            </button>


            <button @class([
                'flex hidden flex-row bg-ugnh-blueClair text-gray-600 dark:text-gray-600 dark:border dark:border-gray-600 p-2 rounded gap-2'
            ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                Annuler
            </button>
            </div>

        </form>
        </div>




    

    </div>

    </div>


    
    <div
        x-data="{
            success: false,
            erreur: false,
            message: ''
        }"

        {{-- SUCCESS EVENT --}}
        @success.window="
            success = true;
            erreur = false;
            message = $event.detail.message;
            setTimeout(() => success = false, 4000);
        "

        {{-- ERROR EVENT --}}
        @erreur.window="
            erreur = true;
            success = false;
            message = $event.detail.message;
        "

        class="fixed top-0 left-0 w-full z-[9999]"
    >

        <!-- ========================= -->
        <!-- SUCCESS TOAST (TOP) -->
        <!-- ========================= -->
        <div
            x-show="success"
            x-transition
            class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-md"
        >
            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L9 10.586l3.293-3.293a1 1 0 011.414 1.414z"/>
            </svg>

            <p x-text="message"></p>
        </div>

        <!-- ========================= -->
        <!-- ERROR MODAL CENTER -->
        <!-- ========================= -->
        <div
            x-show="erreur"
            x-transition.opacity
            class="fixed inset-0 flex items-center justify-center"
        >

            <!-- OVERLAY -->
            <div
                class="absolute inset-0 bg-black/50"
                @click="erreur = false"
            ></div>

            <!-- MODAL BOX -->
            <div
                class="relative bg-white dark:bg-gray-800 w-[90%] sm:w-[420px] rounded-lg shadow-xl p-5 z-10"
            >

                <!-- CLOSE ICON -->
                <button
                    class="absolute top-2 right-2 text-gray-500 hover:text-red-500"
                    @click="erreur = false"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- ICON -->
                <div class="flex justify-center mb-3">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5h2v2H9v-2zm0-8h2v6H9V5z"
                                clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <!-- TITLE -->
                <h2 class="text-center text-lg font-bold text-red-600 mb-2">
                    Erreur
                </h2>

                <!-- MESSAGE -->
                <p class="text-center text-gray-600 dark:text-gray-300"
                x-text="message">
                </p>

                <!-- BUTTON -->
                <div class="mt-5 flex justify-center">
                    <button
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                        @click="erreur = false"
                    >
                        Fermer
                    </button>
                </div>

            </div>
        </div>

    </div>

        
    </section>





  


