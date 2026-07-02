
<section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
])
x-show="form"
x-transition.duration.300ms

>


    
    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-20 dark:opacity-60 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>







    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white  dark:border-5 dark:border-gray-600 relative dark:bg-gray-800 lg:w-[60%]  sm:w-[80%] w-full sm:h-auto h-full rounded-lg shadow-2xl overflow-y-auto ">
             
            
        <section
            x-data="{ show:false }"
            x-on:open-modal.window="
                show = true;
                setTimeout(() => show = false, 900);
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
            {{-- wire:click="resetForm" --}}
            <div @class(['fixed sm:absolute sm:top-2  z-50 sm:top-0 top-1 right-1 sm:right-0 bg-red-500 sm:bg-transparent  cursor-pointer  p-1 sm:text-red-500 text-gray-50 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            @click="form = !form"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

                        
            <div class="sm:text-2xl text-normal sm:relative fixed w-full top-0 left-0  font-bold p-3 text-center bg-ugnh-blueClair sm:rounded-t-sm rounded-none dark:text-gray-600">
                Ajouter des notes
            </div>

                @if(session()->has('successNote'))
                    <div
                        x-data="{ show: true }"
                        x-init="
                            setTimeout(() => {
                                show = false;
                                $wire.clearFlash();
                            }, 2000)
                        "
                        x-show="show"
                        x-transition
                        class="m-4 p-4 rounded-lg bg-green-100 text-green-700"
                    >
                        {{ session('successNote') }}
                    </div>
                @endif

                @if(session()->has('erreur'))
                    <div
                        x-data="{ show: true }"
                        x-init="
                            setTimeout(() => {
                                show = false;
                                $wire.clearFlash();
                            }, 3000)
                        "
                        x-show="show"
                        x-transition
                        class="m-4 p-4 rounded-lg bg-red-200 text-red-700"
                    >
                        {{ session('erreur') }}
                    </div>
                @endif
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
            {{-- <div @class(['flex sm:flex-row flex-col gap-5 '])>
                <div class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="nom">Code:</label>
                <input wire:model.live="code" @readonly(true) @class(['outline-0 border-b border-gray-600 w-full mx-3']) type="text" id="nom" >
                </div>
            </div> --}}

               <div class=" flex flex-row">
                    <label class="font-bold text-gray-500"  for="sexe">
                        Faculte
                    </label>
                    <div class="relative w-[90%]  pb-4">
                    <select wire:model.live="codeFac" @class([
                    'outline-0 border-b border-gray-600 mx-3 w-full',
                    'border-red-600'=>$errors->has('codeFac'),
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                    ]) name="" id="codeFac">
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Choisir la faculte</option>

                        @foreach ($this->Facultes as $faculte)
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                        @endforeach
                    </select>
                     @error('codeFac') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>
                </div>


                <div class=" flex flex-row">
                    <label class="font-bold text-gray-500"  for="niveau">
                        Niveau
                    </label>
                    <div class="relative w-[90%]  pb-4">
                    <select wire:model.live="niveau" @class([
                    'outline-0 border-b border-gray-600 mx-3 w-full',
                    'border-red-600'=>$errors->has('niveau'),
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                    ]) name="" id="niveau">
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Choisir le niveau</option>

                        {{-- @foreach ($this->Facultes as $faculte) --}}
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="3">III</option>
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="4">IV</option>
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="V">V</option>
                        {{-- @endforeach --}}
                    </select>
                     @error('niveau') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>
                </div>

                @php
                    $role = Auth::user()->roles->first()->nom ?? '';
                    $isAdmin = $role = 'Administrateur';
                    $isSecretaireGenerale = $role == "Secrétaire générale";
                    $doyenFaculte = $role == "Doyen de faculté";
                    $VicedoyenFaculte = $role == "Vice-doyen de faculté";
                    $SecretaireFaculte = $role == "Secretaire faculte";
                    $Secrétaireadjoint = $role == "Secrétaire adjoint";
                @endphp  
                
                @if ($isAdmin ||  $isSecretaireGenerale || $doyenFaculte )
                    <div class=" flex flex-row">
                        <label class="font-bold text-gray-500"  for="niveau">
                            Session
                        </label>
                        <div class="relative w-[90%]  pb-4">
                        <select wire:model.live="session" @class([
                        'outline-0 border-b border-gray-600 mx-3 w-full',
                        'border-red-600'=>$errors->has('session'),
                        'dark:text-ugnh-blueClair dark:border-gray-600'
                        ]) name="" id="session">
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="">Choisir la session</option>

                            {{-- @foreach ($this->Facultes as $faculte) --}}
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                            {{-- @endforeach --}}
                        </select>
                        @error('session') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                        </div>
                    </div>
                @endif

                <div class=" flex flex-row">
                    <label class="font-bold text-gray-500"  for="sexe">
                        Etudiant
                    </label>
                    <div class="relative w-[90%]  pb-4">
                    <select wire:model.live="matricule" @class([
                    'outline-0 border-b border-gray-600 mx-3 w-full',
                    'border-red-600'=>$errors->has('matricule'),
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                    ]) name="" id="matricule">
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Choisir l'etudiant</option>

                        @if ($this->codeFac !="" && $this->niveau!=""){
                             @foreach ($this->Etudiants as $etudiant)
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $etudiant->etudiant->matricule ?? "" }}">{{ $etudiant->etudiant->nom ?? ""}} {{ $etudiant->etudiant->prenom ?? "" }}</option>
                            @endforeach
                        }     
                        @endif
                       
                    </select>
                     @error('matricule') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>
                </div>         

            
            </div>


            <div  @class([
                'flex flex-col gap-5 border border-gray-200 shadow-sm p-6',
                'dark:border-gray-600'
            ])>
            <h1 class="font-bold text-xl">Renseignements sur la notes <span class="text-xs font-normal italic"></span></h1>


            <div class=" flex flex-row">
                <label class="font-bold text-gray-500"  for="typeEvaluation">Type d'evaluation:</label>
                <div class="relative w-[75%]  pb-4">
                <select wire:model.live="typeEvaluation" @class([
                'outline-0 border-b border-gray-600 mx-3',
                'dark:text-ugnh-blueClair dark:border-gray-600',
                'border-red-600'=>$errors->has('typeEvaluation')
                ]) name="" id="typeEvaluation">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value=""></option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="Intra">Intra</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="Examen Final">Examen Final</option>
                    {{-- <option class="dark:text-gray-200 dark:bg-gray-600" value="Note de rattrapage">Note de rattrapage</option> --}}
                </select>
                @error('typeEvaluation') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>
            </div>

                



            <div @class(['flex  flex-col gap-5 '])>

                <div class=" flex flex-row">
                    <label class="font-bold text-gray-500"  for="conditionMatrimoniale">
                        Cours
                    </label>
                    <div class="relative w-[90%]  pb-4">
                    <select wire:model.live="codeCours" @class([
                    'outline-0 border-b border-gray-600 mx-3 w-full',
                    'border-red-600'=>$errors->has('codeCours'),
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                    ]) name="" id="codeCours">
                        <option class="dark:text-ugnh-blueFonce" value=""></option>
                        @if ($this->Cours !=null)
                            @foreach ($this->Cours as $cours)
                                <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $cours->codeCours }}">{{ $cours->nom }}</option>
                            @endforeach
                        @else
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="">Selection la faculte et le niveau d'abord</option>
                        @endif   
                    </select>
                     @error('codeCours') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class=" w-full flex flex-row">
                <label class="font-bold text-gray-500"  for="email">Note:</label>
                <div class="relative w-[70%]  pb-4">
                <input wire:model.live="note" @class(['outline-0 border border-gray-600 mx-3 sm:w-[80%] w-full rounded-sm p-2  bg-ugnh-blueClair dark:bg-gray-700','border-red-600'=>$errors->has('note')]) type="number" id="note" >
                 @error('note') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                </div>
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                Ajouter
            </button>


            <button @class([
                'flex  hidden flex-row bg-ugnh-blueClair text-gray-600 dark:text-gray-600 dark:border dark:border-gray-600 p-2 rounded gap-2'
            ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                Annuler
            </button>
            </div>

        </form>
        




            {{-- message de succes --}}
            <div
            x-data="{ show: false, message: '' }"

            x-on:p.window="
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




            {{-- message d'erreur --}}
            <div
            x-data="{ show: false, message: '' }"

            x-on:erreur.window="
                show = true;
                message = $event.detail.message;
                setTimeout(() => show = false, 5000);
            "
            x-show="show"
            class="flex w-full overflow-hidden bg-white shadow-md absolute top-0 left-0"
            >

            <div class="flex items-center justify-center w-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-500 fill-current">
                <path fill-rule="evenodd" d="M11.484 2.17a.75.75 0 011.032 0 11.209 11.209 0 007.877 3.08.75.75 0 01.722.515 12.74 12.74 0 01.635 3.985c0 5.942-4.064 10.933-9.563 12.348a.749.749 0 01-.374 0C6.314 20.683 2.25 15.692 2.25 9.75c0-1.39.223-2.73.635-3.985a.75.75 0 01.722-.516l.143.001c2.996 0 5.718-1.17 7.734-3.08zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zM12 15a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75v-.008a.75.75 0 00-.75-.75H12z" clip-rule="evenodd" />
                </svg>

            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-red-500">Erreur</span>

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

    </div>

    </div>
    
</section>

