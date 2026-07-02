
<section class="p-4 m-3 bg-gray-100 dark:bg-gray-900 rounded-2xl">
    {{-- ALERT ERREUR --}}
    <div
        x-data="{
            show: false,
            message: '',
            timeout: null
        }"

        x-on:erreur.window="
            show = true;
            message = $event.detail.message;

            clearTimeout(timeout);

            timeout = setTimeout(() => {
                show = false
            }, 5000);
        "

        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"

        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"

        class="fixed top-5 right-5 z-50"
    >

        <div class="flex items-start gap-3 bg-red-500 text-white px-5 py-4 rounded-2xl shadow-2xl min-w-[320px] max-w-sm">

            <!-- ICON -->
            <div class="mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v3.75m0 3.75h.007v.008H12v-.008zm8.25-.75a8.25 8.25 0 11-16.5 0 8.25 8.25 0 0116.5 0z" />
                </svg>
            </div>

            <!-- MESSAGE -->
            <div class="flex-1">
                <h2 class="font-bold text-lg">
                    Erreur
                </h2>

                <p class="text-sm text-red-100 mt-1" x-text="message"></p>
            </div>

            <!-- CLOSE -->
            <button
                @click="show = false"
                class="hover:bg-red-400 rounded-lg p-1 transition duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>

    </div>
    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Bulletins des Étudiants
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Liste des bulletins disponibles au format PDF
            </p>
        </div>

        {{-- <!-- Recherche -->
        <div class="relative w-full md:w-80">
            <input 
                type="text"
                placeholder="Rechercher un étudiant..."
                class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3 pr-10 outline-none focus:ring-2 focus:ring-red-500 text-gray-700 dark:text-gray-200"
            >

            <svg xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1.5" 
                stroke="currentColor" 
                class="w-5 h-5 absolute right-3 top-3.5 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div> --}}


        {{-- @if (($this->byFaculte !="") &&  ($this->byNiveau !="") )
            @if ($this->listeDesBultin->isNotEmpty())
                <!-- ACTION MASSIVE -->
                <button
                    wire:click="reinscriptionMassive"
                    wire:confirm="Voulez-vous vraiment réinscrire tous les étudiants affichés ?"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl text-sm font-semibold transition shadow-md"
                >
                    🔁 Réinscription en masse
                </button>
            @endif
        @endif --}}


    </div>


    <div @class([
        'flex flex-col items-center justify-between gap-2 bg-ugnh-blueClair mb-5 py-5 px-1 rounded-t border-b border-[#ccc]',
		'md:rounded-t-lg md:flex-row',
		'dark:bg-gray-700 dark:border-gray-600'
    ])>
       
        {{-- <div 
		:class="!inpuRecherche ? 'md:bg-ugnh-blueClair p-1 rounded md:shadow-sm md:w-7  lg:w-full lg:bg-transparent lg:p-0  lg:shadow-none w-full' : 'w-full'"
		@class([
			"flex flex-row items-center relative  ",
			''
		])>
            <input wire:model.live="search" :class="!inpuRecherche ? 'w-full p-1 pe-8  md:w-0 lg:w-full md:p-0 md:pe-0 lg:p-1 lg:pe-8' : 'w-full p-1 pe-8'" class=" bg-blue-50 dark:bg-gray-600 shadow-sm rounded  outline-0  dark:text-gray-300 dark:border-gray-600 " type="text" name="" id="" placeholder="Rechercher">
            <div @click="inpuRecherche= !inpuRecherche"  @class(['bg-ugnh-blueFonce p-1 right-0 rounded absolute md:me-1 me-2 lg:me-1 '])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4  text-gray-50">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div> --}}


        
        <div  
            :class="!inpuRecherche ? '' : 'md:hidden'" 
            @class([
                'flex flex-col md:flex-row items-stretch md:items-center gap-2 w-full',
                'md:w-auto'
            ])
        >
            <!-- Niveau -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full md:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="isNotAdmis"
                    class="outline-0 text-gray-600 w-full bg-transparent dark:text-ugnh-blueClair">

                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">
                        Étudiants admis
                    </option>

                    <option class="text-gray-200 dark:bg-gray-600" value="yes">
                        Étudiants échoués
                    </option>

                </select>
            </div>

            <!-- Faculte -->
            <div @class([
                'flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full md:w-auto'
            ])>
                <div class="bg-ugnh-blueFonce p-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byFaculte"
                    class="outline-0 text-gray-600 w-full bg-transparent dark:text-ugnh-blueClair">
                    <option class="text-gray-200 dark:bg-gray-600" value="">Faculte</option>
                    @foreach ($this->Facultes as $faculte)
                        <option class="dark:text-ugnh-blueFonce" value="{{ $faculte->codeFac }}">
                            {{ $faculte->nom }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Niveau -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full md:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byNiveau"
                    class="outline-0 text-gray-600 w-full bg-transparent dark:text-ugnh-blueClair">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">Niveau</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="1">I</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="2">II</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="3">III</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="4">IV</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="5">V</option>
                </select>
            </div>
        </div>

        @if ($this->isNotAdmis =="")
            @if (($this->byFaculte !="") &&  ($this->byNiveau !="") )
                @if ($this->listeDesBultin->isNotEmpty())
                    <!-- ACTION MASSIVE -->
                    
                    <button
                        wire:click="reinscriptionMassive"
                        wire:confirm="Voulez-vous vraiment réinscrire tous les étudiants affichés ?"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl text-sm font-semibold transition shadow-md"
                    >
                        🔁 Réinscription en masse
                    </button>
                @endif
            @endif
        @else
            @if (($this->byFaculte !="") &&  ($this->byNiveau !="") )
                @if ($this->listeDesBultin->isNotEmpty())
                    <!-- ACTION MASSIVE -->
                    
                    <button
                        wire:click="reinscriptionMassive"
                        wire:confirm="Voulez-vous vraiment réinscrire tous les étudiants affichés ?"
                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-5 py-2 rounded-xl text-sm font-semibold transition shadow-md"
                    >
                        🔁 Réinscription en masse
                    </button>
                @endif
            @endif
        @endif
        


    </div>

    <!-- LISTE PDF -->
    <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        @foreach ($this->listeDesBultin as  $bultins)

            <!-- CARD -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-4 border border-gray-200 dark:border-gray-700 group cursor-pointer">

                <div class="flex flex-col items-center text-center">

                    <!-- ICON PDF -->
                    <div class="bg-red-100 dark:bg-red-900/30 p-5 rounded-2xl mb-4 group-hover:scale-110 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke-width="1.5" 
                            stroke="currentColor" 
                            class="w-14 h-14 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375H14.25m-4.5 0H7.875a3.375 3.375 0 00-3.375 3.375v6.75A3.375 3.375 0 007.875 21h8.25A3.375 3.375 0 0019.5 17.625V14.25m-9-9h3.75m-3.75 0a3.375 3.375 0 00-3.375 3.375m3.375-3.375V3m3.75 2.25V3m0 2.25a3.375 3.375 0 013.375 3.375" />
                        </svg>
                    </div>

                    <!-- INFOS -->
                    <h2 class="font-bold text-gray-800 dark:text-white">
                    {{$bultins->nom}} {{$bultins->prenom}}
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Matricule : {{$bultins->matricule}}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        {{$bultins->faculte->first()?->nom ?? ''}} • Niveau {{$bultins->niveau}}
                    </p>

                    <!-- ACTION -->
                    <button wire:click="voirLePdf('{{ $bultins->matricule }}')" class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl text-sm font-semibold transition">
                        Voir le PDF
                    </button>
                    @if ($this->isNotAdmis =="")
                        <button wire:click="admissionValidee('{{ $bultins->matricule }}')" class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-xl text-sm font-semibold transition">
                            Reinscription
                        </button>
                    @else
                        <button wire:click="admissionEchouee('{{ $bultins->matricule }}')" class="mt-4 w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-xl text-sm font-semibold transition">
                            Reinscription
                        </button>
                    @endif
                    

                </div>
            </div>

            
        @endforeach

    </div>


      @if ($this->listeDesBultin->isEmpty())
            <div class=" mt-10 mb-10 flex w-full m-auto max-w-sm overflow-hidden rounded-lg shadow-md dark:bg-gray-700 p-10 border border-gray-200">
				<div class="flex items-center justify-center w-12 bg-yellow-500 rounded-lg">
					<svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
						<path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
					</svg>
				</div>

				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-yellow-500">Info</span>
						<p class="text-sm text-yellow-500 ">
							Aucun bultin disponible pour le moment!
                        </p>
					</div>
				</div>
			</div>
        
    @endif

    <script>
        window.addEventListener('oppen-df', event => {
            window.open(event.detail.url, '_blank');
        });
    </script>
</section>

