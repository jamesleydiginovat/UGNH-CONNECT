<section @class([
    'w-full h-full overflow-y-hidden fixed z-10 bottom-0 left-0 '
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
            <livewire:pages.pdf.iframes.pdf-fiche-etudiants />
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
    'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-70 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
    ])> 
    </section>

    <div @class(['absolute z-50 sm:top-10  top-3  right-1 cursor-pointer p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
        @if ($ids ==null)
             @click="form = !form ; openListe= false"
             @else
              @click="form = !form ; openListe= !openListe; openListe= false"
        @endif
       
       
        wire:click="makeIdsNull"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>

        <section @class([
            'w-full sm:h-[90vh] h-full p-0 sm:p-3  overflow-hidden  absolute  bottom-0 left-0 rounded-t-lg '
            ])> 

                    <section
                        x-data="{ show:false }"
                        x-on:open-modal.window="
                            show = true;
                            setTimeout(() => show = false, 800);
                        "
                        x-show="show"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        @class([
                            'w-full h-full p-0 sm:p-3 bg-white opacity-100 overflow-hidden dark:bg-gray-800 dark:border-gray-600 absolute z-50 bottom-0 left-0 shadow-sm border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)] flex items-center justify-center'
                        ])
                    >

                        <!-- Spinner -->
                        <div class="flex flex-col items-center gap-3">

                            <div class="animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent"></div>

                            <p class="text-gray-600 dark:text-gray-300 text-sm">
                                Chargement en cours...
                            </p>

                        </div>

                    </section>


            <div @class([
                'flex flex-row h-full justify-between text-gray-600 dark:text-gray-400'
            ])>



                @if ($ids==null)
                    <div @click="openListe= !openListe" class="bg-ugnh-blueFonce rounded-full text-gray-50 p-2 absolute bottom-2 right-2 z-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                @endif

                <div
                {{-- @if ($ids!=null)
                   :class="!openListe ? 'w-0 lg:w-[40%] lg:p-3' : 'w-full lg:w-0 lg:p-0'"
                @else --}}
                    
                    :class="!openListe ? 'w-0 lg:w-0 lg:p-0' : 'w-full lg:w-[40%] lg:p-3'"
                {{-- @endif --}}
                @class([
                  'overflow-x-hidden w-0 no-scrollbar bg-ugnh-blueClair rounded-tl-lg  p-0 transiton-all duration-300 easy-out',
                  'dark:bg-gray-800' 
                ])>
                       <div class="text-2xl font-bold p-3 text-center dark:text-gray-400">
                            Liste des etudiants postuler
                        </div>



                <div class="overflow-x-scroll h-[85vh] overflow-y-auto no-scrollbar  ">
                    <table class="min-w-full text-xs ">
                        <thead class="bg-ugnh-blueClair dark:text-gray-600 ">
                            <tr class="text-left  ">
                                <th class="px-1 py-3">
                                    <p>Matricule</p>
                                </th>
                                <th class="px-1 py-3">
                                    <p>Nom</p>
                                </th>
                                <th class="px-1 py-3">
                                    <p>Prenom</p>
                                </th>
                                <th class="px-1 py-3">
                                    <p>Sexe</p>
                                </th>
                                <th class="px-1 py-3 ">
                                    <p>Faculte</p>
                                </th>
                            
                                <th class="px-1 py-3 w-20 text-center">
                                    <p>Action</p>
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            @foreach ($this->Postulants as $postulant)
                            
                            
                                <tr class="border-b border-[#ccc] dark:border-gray-600">
                                    <td class="p-1">
                                        <p>{{ $postulant->matricule}}</p>
                                    </td>
                                    <td class="p-1">
                                        <p> {{ $postulant->nom}}</p>
                                    </td>
                                    <td class="p-1 text-nowrap overflow-hidden">
                                        <p>{{ $postulant->prenom}} </p>
                                    </td>
                                    <td class="p-1">
                                        <p>{{ $postulant->sexe}}</p>
                                    </td>
                                    <td class="p-1">
                                        <p>{{ $postulant->faculte->first()?->nom ?? '' }}</p>
                                    </td>
                                    
                                    <td class="p-1 flex flex-row justify-center">

                                        <svg wire:click="remplirFromModifier({{ $postulant->id }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-blue-500 hover:scale-110 ">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>

                                        <svg wire:click="deletePostulant({{ $postulant->id }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 hover:text-red-600 hover:scale-110">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>


                </div>





                <div
                 x-data
                 x-on:export-ready.window="document.getElementById('export').click()"
                {{-- @if ($ids!=null)
                    
                    :class="!openListe ? 'w-full lg:w-[60%]' : 'w-0 lg:w-[70%] mx-auto '"
                @else --}}
                    :class="openListe ? 'w-0 overflow-hidden border-none lg:w-[60%] ' : 'w-full lg:w-[70%]'"
                @class([
                    ' w-0 transiton-all h-full mx-auto duration-500 easy-out dark:border-5 dark:border-gray-600 pb-7 sm:pb-0 '
                ])>
                        
                <div class="sm:text-2xl text-normal  font-bold p-3 text-center bg-ugnh-blueClair rounded-t-sm dark:text-gray-600">
                    {{ $ids ? "Modification d'etudiant" : "Formulaire d'inscription pour postulant"}}
                </div>


                {{-- @if ($errors->any())
                <div class="absolute top-0 left-0 mx-3 bottom-0 bg-amber-200">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-500 text-[10px]">{{ $error }}</p>
                    @endforeach
                </div>
                @endif --}}

{{-- Formulaire des postuler un etudiant --}}
                    <form
                    wire:submit="save"
                    @class(['flex flex-col gap-5 sm:pb-10 pb-5 bg-white h-full sm:h-[85vh] relative overflow-y-scroll no-scrollbar overflow-x-hidden',
                            'dark:text-gray-400 dark:bg-gray-800 '
                    ])
                    >

{{-- mmm --}}
                        <div 
                            :class="openListe ? '' : 'hidden lg:block'" 
                            class="sm:w-24 w-10 sm:h-24 h-10 rounded-3xl bg-ugnh-blueFonce absolute sm:top-0 top-7 sm:right-1 right-auto left-1 sm:left-auto border border-gray-300 dark:border-gray-700 cursor-pointer"
                            onclick="document.getElementById('photo').click()"
                        >

                            <img 
                            @if ($ids !=null)
                                @if ($photo)
                                    src="{{ $photo->temporaryUrl() }}" 
                                @else
                                    src="{{ Storage::url("photosEtudiants/".$photoAfficher)}}"
                                    
                                @endif 
                               
                            @else
                                @if ($photo) 
                                    src="{{ $photo->temporaryUrl() }}" 
                                @else 
                                    src="/images/default-user.png" 
                                @endif
                            @endif            
                            class="w-full h-full object-cover rounded-3xl text-center text-gray-50"
                            alt="Ajouter la photo de l'etudiant"
                            >

                            <input 
                                wire:model="photo"
                                type="file" 
                                name="photo" 
                                id="photo"
                                class="hidden"
                            >

                        </div>

                        <div class="flex flex-col gap-5 border border-gray-200 shadow-sm p-6 dark:border-gray-600">
                            <div @class(['flex sm:flex-row flex-col gap-5 '])>
                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="dateCreation">Date:</label>

                                    <div class="relative w-full  pb-4">
                                    <input  @readonly(true) wire:model="dateCreation" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('dateCreation')]) type="text" id="dateCreation" >
                                    @error('dateCreation') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="numFiche">Matricule:</label>

                                    <div class="relative w-full  pb-4">
                                    <input  @readonly(true) wire:model="matricule" @class(['outline-0  w-full mx-3', 'border-red-600'=>$errors->has('matricule')]) type="text" id="numFiche" >
                                    @error('matricule') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                            </div>


                            <div @class(['flex sm:flex-row flex-col gap-5 '])>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="faculte">Faculte:</label>
                                    <div class="relative w-auto  pb-4">
                                    <select
                                       @if ($ids)
                                           @if ($status !='Postulant')
                                            disabled 
                                            @endif
                                       @endif
                                         
                                        wire:click="remplirCodeFac"  wire:model.live="codeFac" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('codeFac')]) name="" id="faculte">
                                        <option value=""></option>
                                        @foreach ($this->Facultes as $faculte)
                                            <option class="dark:text-ugnh-blueFonce" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                                        @endforeach
                                        
                                    </select>
                                    @error('codeFac') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="vacation">Vacation:</label>

                                    <div class="relative w-full  pb-4">
                                    <input   wire:model="vacation" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('vacation')]) type="text" id="vacation" >
                                    @error('vacation') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                            </div>

                        </div>


                            <div @class([
                                'flex flex-col gap-5 border border-gray-200 shadow-sm p-6',
                                'dark:border-gray-600'
                            ])>
                            <h1 class="font-bold text-xl">Renseignements personnels</h1>

                            <div @class(['flex sm:flex-row flex-col gap-5 pe-2 '])>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="nom">Nom:</label>

                                    <div class="relative w-full  pb-4">
                                    <input wire:model.live="nom" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('nom')]) type="text" id="nom" >
                                    @error('nom') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="prenom">Prenom:</label>

                                    <div class="relative w-full  pb-4">
                                    <input wire:model="prenom" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('nom')]) type="text" id="nom" >
                                    @error('prenom') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                            </div>




                            <div @class(['flex sm:flex-row flex-col gap-5 pe-2'])>
                                {{-- <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="nom">Nom:</label>
                                <input wire:model="nom" @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="nom" >
                                </div> --}}


                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="nom">Adresse:</label>

                                    <div class="relative w-full  pb-4">
                                    <input wire:model="adresse" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('adresse')]) type="text" id="nom" >
                                    @error('adresse') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                {{-- <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="prenom">Telephone:</label>

                                    <div class="relative w-full  pb-4">
                                    <input wire:model="telephone" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('telephone')]) type="text" id="nom" >
                                    @error('telephone') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div> --}}



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500" for="telephone">
                                        Téléphone :
                                    </label>

                                    <div class="relative w-[75%] pb-4">
                                        <input
                                            wire:model="telephone"
                                            x-data
                                            x-mask="+509 99-99-9999"
                                            x-init="
                                                if($el.value === ''){
                                                    $el.value = '+509 ';
                                                }
                                            "
                                            @input="
                                                if(!$el.value.startsWith('+509 ')){
                                                    $el.value = '+509 ';
                                                }
                                            "
                                            @class([
                                                'outline-0 border-b border-gray-600 w-full mx-3',
                                                'border-red-600' => $errors->has('telephone')
                                            ])
                                            type="text"
                                            id="telephone"
                                            placeholder="+509 00-00-0000"
                                        >

                                        @error('telephone')
                                            <p class="text-red-500 text-[10px] absolute mx-3 bottom-0">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <div @class(['flex sm:flex-row flex-col gap-5 pe-2'])>
                                {{-- <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="nom">Nom:</label>
                                <input wire:model="nom" @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="nom" >
                                </div> --}}


                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="date">Date de naissance:</label>

                                    <div class="relative w-auto  pb-4">
                                    <input wire:model="dateNaissance" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('dateNaissance')]) type="date" id="date" >
                                    @error('dateNaissance') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="lieuNaissance">Lieu de naissance::</label>

                                    <div class="relative w-auto  pb-4">
                                    <input wire:model="lieuNaissance" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('lieuNaissance')]) type="text" id="lieuNaissance" >
                                    @error('lieuNaissance') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                            </div>




                            <div @class(['flex sm:flex-row flex-col gap-5 pe-2'])>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="sexe">Sexe:</label>
                                    <div class="relative w-full  pb-4">
                                    <select wire:model="sexe" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('dateNaissance')]) name="" id="sexe">
                                        <option value=""></option>
                                        <option class="dark:text-ugnh-blueFonce" value="M">Masculin</option>
                                        <option class="dark:text-ugnh-blueFonce" value="F">Feminin</option>
                                        
                                    </select>
                                    @error('sexe') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="groupeSanguin">Groupe sanguin:</label>
                                    <div class="relative w-auto  pb-4">
                                    <select wire:model="groupeSanguin" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('groupeSanguin')])name="" id="groupeSanguin">
                                       <option class="dark:text-ugnh-blueFonce" value=""></option>
                                        <option class="dark:text-ugnh-blueFonce" value="O+">O+</option>
                                        <option class="dark:text-ugnh-blueFonce" value="O-">O-</option>
                                        <option class="dark:text-ugnh-blueFonce" value="A-">A-</option>
                                        <option class="dark:text-ugnh-blueFonce" value="A+">A+</option>
                                        <option class="dark:text-ugnh-blueFonce" value="B-">B-</option>
                                        <option class="dark:text-ugnh-blueFonce" value="B+">B+</option>
                                        
                                    </select>
                                    @error('groupeSanguin') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="nif_cin">NIF/CIN:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="nif_cin" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('nif_cin')]) type="text" id="nif_cin" >
                                @error('nif_cin') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div> --}}


                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500" for="nif_cin">
                                    NIF/CIN:
                                </label>

                                <div class="relative w-auto pb-4">
                                    <input
                                        wire:model="nif_cin"
                                        x-data
                                        x-mask="999-999-999-9"
                                        @class([
                                            'outline-0 border-b border-gray-600 w-full mx-3',
                                            'border-red-600' => $errors->has('nif_cin')
                                        ])
                                        type="text"
                                        id="nif_cin"
                                        placeholder="000-000-000-0"
                                    >

                                    @error('nif_cin')
                                        <p class="text-red-500 text-[10px] absolute mx-3 bottom-0">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>



                            <div @class(['flex sm:flex-row flex-col gap-5 pe-2'])>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="conditionMatrimoniale">Condition matrimoniale:</label>
                                    <div class="relative w-auto  pb-4">
                                    <select wire:model="conditionMatrimoniale" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('conditionMatrimoniale')]) name="" id="conditionMatrimoniale">
                                        <option value=""></option>
                                        <option class="dark:text-ugnh-blueFonce" value=""></option>
                                        <option class="dark:text-ugnh-blueFonce" value="Célibataire">Célibataire</option>
                                        <option class="dark:text-ugnh-blueFonce" value="Marié(e)">Marié(e)</option>
                                        <option class="dark:text-ugnh-blueFonce" value="Veuf / Veuve">Veuf / Veuve</option>
                                        <option class="dark:text-ugnh-blueFonce" value="Divorcé(e)">Divorcé(e)</option>
                                        <option class="dark:text-ugnh-blueFonce" value="Séparé(e)">Séparé(e)</option>
                                        <option class="dark:text-ugnh-blueFonce" value="Union libre">Union libre </option>
                                        <option class="dark:text-ugnh-blueFonce" value="Fiancé(e)">Fiancé(e)</option>
                                        
                                    </select>
                                    @error('conditionMatrimoniale') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="email">E-mail:</label>

                                    <div class="relative w-auto  pb-4">
                                    <input wire:model="email" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('email')]) type="email" id="email" >
                                    @error('email') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                            </div>



                            </div>



                            <div @class([
                                'flex flex-col gap-5 border border-gray-200 shadow p-6',
                                'dark:border-gray-600'
                            ])>
                            <h1 class="font-bold text-xl">Autres renseignements</h1>

                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="occupationAcctuelle">Occupation actuelle:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="occupationAcctuelle" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('occupationAcctuelle')]) type="text" id="occupationAcctuelle" >
                                @error('occupationAcctuelle') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div>


                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="lieuDeTravail">Lieu de travail:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="lieuDeTravail" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('lieuDeTravail')]) type="text" id="lieuDeTravail" >
                                @error('lieuDeTravail') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div>


                            <h1 class="font-bold text-xl">Renseignements sur la personne responsable</h1>

                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="nomPrenomPersonneR">Nom et Prenom:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="nomPrenomPersonneR" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('nomPrenomPersonneR')]) type="text" id="nomPrenomPersonneR" >
                                @error('nomPrenomPersonneR') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div>



                            {{-- <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="telephone">Telephone:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="telephonePersonneR" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('telephonePersonneR')]) type="text" id="telephone" >
                                @error('telephonePersonneR') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div> --}}

                            <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500" for="telephone">
                                        Téléphone :
                                    </label>

                                    <div class="relative w-[75%] pb-4">
                                        <input
                                            wire:model="telephonePersonneR"
                                            x-data
                                            x-mask="+509 99-99-9999"
                                            x-init="
                                                if($el.value === ''){
                                                    $el.value = '+509 ';
                                                }
                                            "
                                            @input="
                                                if(!$el.value.startsWith('+509 ')){
                                                    $el.value = '+509 ';
                                                }
                                            "
                                            @class([
                                                'outline-0 border-b border-gray-600 w-full mx-3',
                                                'border-red-600' => $errors->has('telephonePersonneR')
                                            ])
                                            type="text"
                                            id="telephonePersonneR"
                                            placeholder="+509 00-00-0000"
                                        >

                                        @error('telephonePersonneR')
                                            <p class="text-red-500 text-[10px] absolute mx-3 bottom-0">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>






                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="lien">Lien:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="lien" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('lien')]) type="text" id="lien" >
                                @error('lien') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div>


                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="PersonneReferences">Qui vous a referer a l'UGNH ?:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="PersonneReferences" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('PersonneReferences')]) type="text" id="PersonneReferences" >
                                @error('PersonneReferences') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div>



                            </div>




                            <div @class([
                                'flex flex-col gap-5 border border-gray-200 shadow p-6',
                                'dark:border-gray-600'
                            ])>
                            <h1 class="font-bold text-xl text-center">Niveau d'etude</h1>
                            <h2 class="font-bold ">Etudes Secondaire</h2>

                            <div @class(['flex flex-col gap-5 '])>



                            <div @class(['flex sm:flex-row flex-col gap-5 pe-2'])>

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="niveauBac">Niveau:</label>
                                    <div class="relative w-auto  pb-4">
                                    <select wire:model="niveauBac" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('niveauBac')]) name="" id="niveauBac">
                                        <option value=""></option>
                                       <option class="dark:text-ugnh-blueFonce" value="Bac I">BAC I</option>
                                        <option class="dark:text-ugnh-blueFonce" value="Bac II">BACC II</option>
                                        
                                    </select>
                                    @error('niveauBac') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="anneeBac">Annee:</label>

                                    <div class="relative w-auto  pb-4">
                                    <input wire:model="anneeBac" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('anneeBac')]) type="text" id="anneeBac" >
                                    @error('anneeBac') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>
                            </div>


                            <div class="sm:w-1/2 w-full flex flex-row">
                                <label class="font-bold text-gray-500"  for="etablissementBac">Etablissement:</label>

                                <div class="relative w-auto  pb-4">
                                <input wire:model="etablissementBac" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('etablissementBac')]) type="text" id="etablissementBac" >
                                @error('etablissementBac') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>

                            </div>

                            </div>




                            <h2 class="font-bold">Etudes Superieures</h2> 
                            <div @class(['flex sm:flex-row flex-col gap-5 '])>


                                <div class="w-full flex flex-col  gap-5">
                                        
                                        <div class="sm:w-1/2 w-full flex flex-row">
                                            <label class="font-bold text-gray-500"  for="niveauES">Niveau:</label>
                                            <div class="relative w-auto  pb-4">
                                            <select wire:model="niveauES" @class(['outline-0 border-b border-gray-600 w-auto mx-3', 'border-red-600'=>$errors->has('niveauES')]) name="" id="niveauES">
                                                <option value=""></option>
                                                <option class="dark:text-ugnh-blueFonce" value="I">I</option>
                                                <option class="dark:text-ugnh-blueFonce" value="II">II</option>
                                                <option class="dark:text-ugnh-blueFonce" value="III">III</option>
                                                <option class="dark:text-ugnh-blueFonce" value="IV">IV</option>
                                                <option class="dark:text-ugnh-blueFonce" value="V">V</option>
                                                <option class="dark:text-ugnh-blueFonce" value="VI">VI</option>
                                                
                                            </select>
                                            @error('niveauES') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                            </div>

                                        </div>

                                        <div class="sm:w-1/2 w-full flex flex-row">
                                            <label class="font-bold text-gray-500"  for="anneeES">Annee:</label>

                                            <div class="relative w-auto  pb-4">
                                            <input wire:model="anneeES" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('anneeES')]) type="text" id="anneeES" >
                                            @error('anneeES') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                            </div>

                                        </div>
                                
                                </div>

                                <div class="w-full flex flex-col gap-5">

                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="disciplineES">Discipline:</label>

                                    <div class="relative w-auto  pb-4">
                                    <input wire:model="disciplineES" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('disciplineES')]) type="text" id="disciplineES" >
                                    @error('disciplineES') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>



                                <div class="sm:w-1/2 w-full flex flex-row">
                                    <label class="font-bold text-gray-500"  for="etablissement">Etablissement:</label>

                                    <div class="relative w-auto  pb-4">
                                    <input wire:model="etablissementES" @class(['outline-0 border-b border-gray-600 w-full mx-3', 'border-red-600'=>$errors->has('etablissementES')]) type="text" id="etablissementES" >
                                    @error('etablissementES') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                    </div>

                                </div>

                                </div>

                            </div>

                            </div>


                            <div @class([
                                'flex flex-row justify-between gap-5 border border-gray-200 shadow p-6',
                                'dark:border-gray-600'
                            ])>

                             <button @class([
                                'flex flex-row bg-ugnh-blueFonce text-gray-50 dark:text-gray-300 dark:border dark:border-gray-600 p-2 rounded gap-2'
                            ])
                            onclick="document.getElementById('export').click()"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                </svg>
                                 {{ $ids ? "Modifier" : "Inscrire"}}
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

                    {{-- <button wire:click="export" id="export">
                        export
                    </button> --}}
                </div>
            </div>



        
           
        </section>

    </div>


    {{-- message de succes --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:success.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 3000);
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





            {{-- message d'info --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:info.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 5000);
    "
    x-show="show"
    class="flex w-full overflow-hidden bg-white shadow-md absolute top-0 left-0"
    >

    <div class="flex items-center justify-center w-12">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500 ">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
        </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
            <span class="font-semibold text-yellow-500">Information</span>

            <p class="text-sm text-gray-600" x-text="message"></p>
        </div>
    </div>

    </div>
   
    
</section>