
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
                <div class="flex flex-row items-center relative">
                    <input wire:model.live="rechercherEtudiant" class="border pe-10 border-ugnh-blueClair shadow-sm rounded-lg p-2 w-full outline-none" type="text" name="" id="" placeholder="Rechercher l'etudiant" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 absolute cursor-pointer hover:bg-ugnh-blueHover bg-ugnh-blueFonce text-white p-1 rounded-lg top-2 right-2 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
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
                'flex flex-row bg-ugnh-blueClair text-gray-600 dark:text-gray-600 dark:border dark:border-gray-600 p-2 rounded gap-2'
            ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                Annuler
            </button>
            </div>

        </form>
        </div>




    {{-- message de succes --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:success.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 5000);
    "
    x-show="show"
    class="flex w-full overflow-hidden bg-white shadow-md absolute top-0 left-0"
    >

    <div class="flex items-center justify-center w-12">
        <svg class="w-6 h-6 text-emerald-500 fill-current" viewBox="0 0 40 40">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
        </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
            <span class="font-semibold text-emerald-500">Success</span>

            <p class="text-sm text-gray-600" x-text="message"></p>
        </div>
    </div>

    </div>

    </div>

    </div>



     <section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
    ])
    x-data="{ InfosConnect: false, message: '' }"

    x-on:erreur.window="
        InfosConnect = true;
        message = $event.detail.message;
        {{-- setTimeout(() => show = false, 5000); --}}
    "
    x-show="InfosConnect"
    {{-- x-show="modalConfirmation" --}}
    x-transition.duration.300ms
    >



        <section @class([
            'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-20 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
            ])> 
        </section>



        <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

            <div class="bg-white relative rounded-lg p-5 dark:bg-gray-800 lg:w-[40%]  sm:w-[50%] w-full  h-auto  shadow-2xl overflow-y-auto ">
            
                <div @class(['absolute z-50 sm:top-0 top-5 right-0   cursor-pointer  p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
                @click="InfosConnect = !InfosConnect"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div> 
                
                <div class="flex flex-row gap-5">
                    <div class="relative w-[10%]">
                        <div class=" bg-ugnh-blueFonce absolute p-2 rounded-full top-0 left-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                    </div>

                    <div class="w-[90%]">
                        <h1 class="font-bold text-xl mb-3 dark:text-gray-50">Information</h1>
                        {{-- <p>Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.</p> --}}
                        {{-- <p class="text-sm text-gray-600" x-text="message"></p> --}}
                        <p class="italic mb-1 dark:text-gray-50">{{ $this->paimentFullPlus}}</p>
                        {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure non consectetur deleniti rerum velit? Accusantium inventore recusandae explicabo obcaecati porro, quia cum commodi laudantium, culpa voluptatibus illum amet harum? Veritatis.</p> --}}

                    </div>
                </div>
            </div>

        </div>
        
    </section>





    {{-- message de succes --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:success-user.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 5000);
    "
    x-show="show"
    class="flex w-full overflow-hidden bg-white shadow-md absolute top-0 left-0"
    >

    <div class="flex items-center justify-center w-12">
        <svg class="w-6 h-6 text-emerald-500 fill-current" viewBox="0 0 40 40">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
        </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
            <span class="font-semibold text-emerald-500">Success</span>

            <p class="text-sm text-gray-600" x-text="message"></p>
        </div>
    </div>

    </div>
    
</section>



{{-- 

<div @class([
                'flex flex-row justify-between text-gray-600 dark:text-gray-400'
            ])> --}}

                {{-- <div @click="openListe= !openListe" class="bg-ugnh-blueFonce rounded-full text-gray-50 p-2 absolute bottom-2 right-2 z-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div> --}}


                {{-- <div :class="!openListe ? 'w-full lg:w-[60%]' : 'w-0 lg:w-full '"  @class([
                    ' w-0 transiton-all duration-500 easy-out mx-auto'
                ])>
                        
                        <div class="sm:text-2xl text-normal  font-bold p-3 text-center bg-ugnh-blueClair rounded-t-3xl dark:text-gray-600">
                            Ajouter un nouveau personnel
                        </div>


                        <form wire:submit="save" 
                            @class(['flex flex-col gap-5 sm:pb-10 pb-5  h-[85vh]   overflow-y-scroll no-scrollbar overflow-x-hidden',
                                    'dark:text-gray-400'
                            ])
                            >

                        
                            <div class="sm:w-24 w-10 sm:h-24 h-10 rounded-full overflow-hidden bg-ugnh-blueFonce absolute sm:top-4 top-7 sm:right-25 right-auto left-1 sm:left-auto border  border-gray-300 dark:border-gray-700">
                                <img
                                    src="{{ asset('images/406659423c8827afe36441daaee8d9b2.jpg') }}"
                                    alt=""
                                    class="w-full h-full  object-cover text-center "
                                >

                                div
                            </div>



                            <div class="flex flex-col gap-5 border border-gray-200 shadow-sm p-6 dark:border-gray-600">
                            <div @class(['flex sm:flex-row flex-col gap-5 '])>
                                <div class=" w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="nom">Code:</label>
                                <input wire:model="code"  @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="nom" >
                                </div>
                            </div>


                            <div class=" flex flex-row">
                                <label class="font-bold text-gray-500"  for="sexe">
                                    Fonction
                                </label>
                                <select wire:model="fonction" @class([
                                'outline-0 border-b border-gray-600 mx-3 w-full',
                                'dark:text-ugnh-blueClair dark:border-gray-600'
                                ]) name="" id="sexe">
                                    <option class="dark:text-ugnh-blueFonce" value="Administrateur">Administrateur</option>
                                    <option class="dark:text-ugnh-blueFonce" value="Secretaire">Secretaire</option>
                                    <option class="dark:text-ugnh-blueFonce" value="Doyen faculte">Doyen faculte</option>
                                    <option class="dark:text-ugnh-blueFonce" value="Comptable">Comptable</option>
                                    <option class="dark:text-ugnh-blueFonce" value="Vice Doyen">Vice Doyen </option>
                                    <option class="dark:text-ugnh-blueFonce" value="Bibliothecaire">Bibliothecaire </option>
                                    <option class="dark:text-ugnh-blueFonce" value="">etc...</option>
                                    
                                </select>
                            </div>

                            </div>


                            <div  @class([
                                'flex flex-col gap-5 border border-gray-200 shadow-sm p-6',
                                'dark:border-gray-600'
                            ])>
                            <h1 class="font-bold text-xl">Renseignements personnels <span class="text-xs font-normal italic">(remplissage automatique)</span></h1>


                            <div @class(['flex sm:flex-row flex-col gap-5 '])>
                                <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="nom">Nom:</label>
                                <input wire:model="nom" @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="nom" >
                                </div>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="Prenom">Prenom:</label>
                                <input wire:model="prenom" @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="prenom" >
                                </div>
                            </div>

                            <div @class(['flex sm:flex-row flex-col gap-5 '])>
                                <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="adresse">Adresse:</label>
                                <input wire:model="adresse" @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="adresse" >
                                </div>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="telephone">Telephone:</label>
                                <input wire:model="telephone" @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="telephone" >
                                </div>
                            </div>


                                <div class="flex sm:flex-row flex-col gap-5 w-full">
                                    <div class=" flex flex-row">
                                        <label class="font-bold text-gray-500"  for="sexe">Sexe:</label>
                                        <select wire:model="sexe" @class([
                                        'outline-0 border-b border-gray-600 mx-3',
                                        'dark:text-ugnh-blueClair dark:border-gray-600'
                                        ]) name="" id="sexe">
                                            <option class="dark:text-ugnh-blueFonce" value="M">Masculin</option>
                                            <option class="dark:text-ugnh-blueFonce" value="F">Feminin</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                



                            <div @class(['flex sm:flex-row flex-col gap-5 '])>
                                <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="conditionMatrimonial">Condition matrimoniale:</label>
                                <input @class(['outline-0 border-b border-gray-600 mx-3 w-[90%] sm:w-auto  ']) type="text" id="conditionMatrimonial" >
                                </div>

                                <div class="sm:w-1/2  w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="email">E-mail:</label>
                                <input wire:model="email" @class(['outline-0 border-b border-gray-600 mx-3 sm:w-[70%] w-full']) type="email" id="email" >
                                </div>
                            </div>

                            </div>

                            




                            <div @class([
                                'flex flex-row justify-between gap-5 border border-gray-200 shadow p-6',
                                'dark:border-gray-600'
                            ])>

                             <button
                             type="submit"
                             @class([
                                'flex flex-row bg-ugnh-blueFonce text-gray-50 dark:text-gray-300 dark:border dark:border-gray-600 p-2 rounded gap-2'
                            ])
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Ajouter
                            </button>


                            <button @class([
                                'flex flex-row bg-ugnh-blueClair text-gray-600 dark:text-gray-600 dark:border dark:border-gray-600 p-2 rounded gap-2'
                            ])>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                Annuler
                            </button>
                            </div>

                        </form>

                </div> --}}
            {{-- </div> --}}
