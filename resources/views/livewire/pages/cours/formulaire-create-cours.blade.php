<section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
])
x-show="form"
x-transition.duration.300ms

>



    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-20 dark:opacity-80 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white relative dark:border-5 dark:border-gray-600 dark:bg-gray-800 lg:w-[60%]  sm:w-[80%] w-full sm:h-auto h-full rounded-lg shadow-2xl overflow-y-auto ">
           
            
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


            <div @class(['fixed sm:absolute sm:top-0  z-50 sm:top-0 top-1 right-1 sm:right-0 bg-red-500 sm:bg-transparent  cursor-pointer  p-1 sm:text-red-500 text-gray-50 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            wire:click="resetForm"
            @click="form = !form"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>


            <div class="sm:text-2xl text-normal sm:relative fixed w-full top-0 left-0  font-bold p-3 text-center bg-ugnh-blueClair sm:rounded-t-sm rounded-none dark:text-gray-600">
                {{ $this->titreForm() }}
            </div>
           <form wire:submit="save" 
            @class(['flex flex-col gap-5  overflow-y-scroll no-scrollbar overflow-x-hidden sm:mt-0 mt-15',
                    'dark:text-gray-400'
            ])
            >

    
            <div  @class([
                'flex flex-col gap-5 border border-gray-200 shadow-sm p-6',
                'dark:border-gray-600'
            ])>

                  <div class="flex flex-col gap-5 border border-gray-200 shadow-sm p-6 dark:border-gray-600">

                            <div class=" w-full flex flex-row">
                            <label class="font-bold text-gray-500"  for="codeCours">Code:</label>
                            <div class="relative w-[90%]  pb-4">
                            <input @readonly(true) wire:model.live="codeCours" @class(['outline-0 border-b border-gray-600 w-full mx-3','border-red-600'=>$errors->has('codeCours')]) type="text" id="codeCours" >
                            @error('codeCours') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                            </div>
                            </div>

                            <div class=" w-full flex flex-row">
                            <label class="font-bold text-gray-500"  for="nom">Nom:</label>
                            <div class="relative w-[90%]  pb-4">
                            <input wire:model.live="nom" @class(['outline-0 border-b border-gray-600 w-full mx-3','border-red-600'=>$errors->has('nom')]) type="text" id="nom" >
                            @error('nom') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                            </div>
                            </div>


                            <div class=" flex flex-row">
                                <label class="font-bold text-gray-500"  for="sexe">
                                    Faculte
                                </label>
                                <div class="relative w-[90%]  pb-4">
                                <select wire:model.live="codeFac" @class([
                                'outline-0 border-b border-gray-600 mx-3 w-full',
                                'dark:text-ugnh-blueClair dark:border-gray-600'
                                ,'border-red-600'=>$errors->has('codeFac')]) name="" id="sexe">
                                    {{-- <option value=""></option> --}}
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="">Choisir la faculte</option>
                                    @foreach ($this->Facultes as $faculte )
                                        <option class="dark:text-gray-200 dark:bg-gray-700" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                                    @endforeach
                                   
                                    
                                </select>
                                 @error('codeFac') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>
                            </div>

                             <div class=" flex flex-row">
                                <label class="font-bold text-gray-500"  for="sexe">
                                    Niveau
                                </label>
                                <div class="relative w-[90%]  pb-4">
                                <select wire:model.live="niveau" @class([
                                'outline-0 border-b border-gray-600 mx-3 w-full',
                                'dark:text-ugnh-blueClair dark:border-gray-600'
                                ,'border-red-600'=>$errors->has('niveau')]) name="" id="sexe">
                                    {{-- <option value=""></option> --}}
                                    {{-- <option class="dark:text-ugnh-blueFonce" value="">Choisir le personnel</option> --}}
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="">Choisir le niveau</option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="1">I</option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="2">II</option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="3">III </option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="4">IV </option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="5">V</option>
                                    
                                </select>
                                @error('niveau') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>
                            </div>




                            <div class=" flex flex-row">
                                <label class="font-bold text-gray-500"  for="sexe">
                                    Session
                                </label>
                                 <div class="relative w-[90%]  pb-4">
                                <select wire:model.live="session" @class([
                                'outline-0 border-b border-gray-600 mx-3 w-full',
                                'dark:text-ugnh-blueClair dark:border-gray-600'
                                ,'border-red-600'=>$errors->has('session')]) name="" id="sexe">
                                    {{-- <option value=""></option> --}}
                                    {{-- <option class="dark:text-ugnh-blueFonce" value="">Choisir le personnel</option> --}}
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="">Choisir la session</option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="1">I</option>
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="2">II</option>
                                </select>
                                @error('session') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>
                            </div>



                             <div class=" flex flex-row">
                                <label class="font-bold text-gray-500"  for="sexe">
                                    Professeur
                                </label>
                                <div class="relative w-[90%]  pb-4">
                                <select wire:model.live="codeProf" @class([
                                'outline-0 border-b border-gray-600 mx-3 w-full',
                                'dark:text-ugnh-blueClair dark:border-gray-600'
                                ,'border-red-600'=>$errors->has('codeProf')]) name="" id="sexe">
                                    {{-- <option value=""></option> --}}
                                    {{-- <option class="dark:text-ugnh-blueFonce" value="">Choisir le personnel</option> --}}
                                    <option class="dark:text-gray-200 dark:bg-gray-700" value="">Choisir le professeurs</option>
                                    @foreach ($this->Professeurs as $professeur)
                                         <option class="dark:text-gray-200 dark:bg-gray-700" value="{{ $professeur->codeProf }}">{{ $professeur->nom." ".$professeur->prenom. "( ".$professeur->specialite." )" }}</option>
                                    @endforeach
                                </select>
                                @error('codeProf') <p class="text-red-500 text-[10px] absolute  mx-3 bottom-0">{{ $message }}</p> @enderror
                                </div>
                            </div>

                        </div>

            {{-- <div @class(['flex  flex-col gap-5 '])> --}}
               

            <div @class([
                'flex flex-row justify-between gap-5 border border-gray-200 shadow p-6',
                'dark:border-gray-600'
            ])>
            <button
            @class([
            'flex flex-row bg-ugnh-blueFonce text-gray-50 dark:text-gray-300 dark:border dark:border-gray-600 p-2 rounded gap-2'
            ])
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                creer
            </button>


            <button
            wire:click="resetForm"
            @click="form = !form"
            @class([
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




    {{-- message d'info --}}
    <div
        x-data="{ show: false, message: '' }"

        x-on:info.window="
            show = true;
            message = $event.detail.message;
            setTimeout(() => show = false, 5000);
        "
        x-show="show"
        class="flex w-full overflow-hidden bg-white dark:bg-gray-700 shadow-md absolute top-0 z-50 left-0"
        >

        <div class="flex items-center justify-center w-12">
            <svg class="w-6 h-6 text-yellow-500 fill-current" viewBox="0 0 40 40">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
            </svg>


        </div>

        <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
                <span class="font-semibold text-yellow-500">Infos</span>

                <p class="text-sm text-gray-600 dark:text-gray-200"  x-text="message"></p>
                {{-- <p class="text-sm text-gray-600">reussit avec succes</p> --}}
                
            </div>
        </div>

        </div>

    </div>
    
</section>




