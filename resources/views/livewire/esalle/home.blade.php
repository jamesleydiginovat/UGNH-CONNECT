<section x-data="{ open: false, openS:false, salleProf:false, remiseDesvoir:false }">

    @if (session('user_type')=="professeur")
    <section class="mx-3  flex flex-row justify-between bg-gray-900 p-3 rounded-lg ">
        <div>

        </div>
        
           <div class="flex flex-row gap-2">
                <button @click="page = 'devoirs'" class="p-2 rounded-lg bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:scale-105 transition-all ease-in-out duration-200">Ajouter un devoir</button>
                <button @click="page = 'document'" class="p-2 rounded-lg border border-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:scale-105 transition-all ease-in-out duration-200">Ajouter un document</button>
            </div> 
        
    </section>
    @endif







    @if (session('user_type')=="etudiant")
    <section 
        class="mx-3 flex flex-row justify-between items-center bg-gray-900 p-3 rounded-lg text-white"
        x-data="{ openNotif: false }"
    >

        <!-- LEFT (vide ou logo) -->
        <div></div>

        <!-- CENTER -->
        <div class="flex flex-row gap-2 items-center">
            <p class="text-3xl font-bold">
                {{ session('user_nomFac') }}
            </p>

            <p class="text-sm text-gray-300">
                Niveau: {{ session('user_niveau') }}
            </p>
        </div>

        <!-- RIGHT (NOTIFICATION) -->
        <div class="relative">

            <!-- BELL -->
            <div 
                class="cursor-pointer relative p-2 hover:bg-gray-800 rounded-full transition"
                @click="openNotif = !openNotif"
            >
                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke-width="1.5" stroke="currentColor" 
                    class="w-6 h-6 text-gray-200">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>

                <!-- COUNTER -->
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                    {{ $this->Notification->count() ?? 0 }}
                </span>
            </div>

            <!-- DROPDOWN -->
            <div 
                x-show="openNotif"
                @click.away="openNotif = false"
                x-transition
                class="absolute right-0 mt-3 w-80 bg-white text-gray-800 rounded-lg shadow-sm overflow-hidden dark:bg-gray-800 dark:border-gray-700 dark:text-gray-50 z-50"
            >

                <!-- HEADER -->
                <div class="p-3 border-b font-bold bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-50">
                    Notifications
                </div>

                @if( count($this->Notification)> 0)
                    <button wire:click="markAllAsSeen"
                            class="text-xs px-3 py-1 rounded-md 
                                bg-blue-500 m-3 hover:bg-blue-600 
                                text-white transition">

                        Marquer tout comme lu

                    </button>
                @endif

                <!-- LIST -->
                <div class="max-h-80 overflow-y-auto no-scrollbar">

                    @if ($this->Notification && count($this->Notification) > 0)

                        @foreach ($this->Notification as $notification)

                            <div class="p-3 border-b border-gray-200 dark:border-gray-700 
                                         dark:bg-gray-800 transition">

                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $notification->title ?? 'Notification' }}
                                </p>

                                <p class="text-xs text-gray-600 dark:text-gray-300 mt-1">
                                    {{ $notification->message }}
                                </p>

                                <span class="text-[10px] text-gray-400 dark:text-gray-500 mt-1 block">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>

                            </div>

                        @endforeach

                    @else
                        <div class="p-4 text-center text-gray-500 text-sm">
                            Aucune notification
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </section>

    @endif


    @if (!$this->isSecure())
        <div 
            x-data="{ open: true }" 
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-10"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-10"
            class="relative m-3 p-4 bg-red-100 text-red-800 border-l-4 border-red-500 rounded-xl shadow-md"
        >

            <!-- BOUTON FERMER -->
            <button 
                @click="open = false"
                class="absolute top-2 right-2 text-red-700 hover:text-red-500 transition text-lg font-bold"
                title="Fermer"
            >
                ✕
            </button>

            <!-- CONTENU -->
            <div class="flex items-start gap-3">

                <!-- ICONE -->
                <div class="text-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-500">
                    <path fill-rule="evenodd" d="M11.484 2.17a.75.75 0 011.032 0 11.209 11.209 0 007.877 3.08.75.75 0 01.722.515 12.74 12.74 0 01.635 3.985c0 5.942-4.064 10.933-9.563 12.348a.749.749 0 01-.374 0C6.314 20.683 2.25 15.692 2.25 9.75c0-1.39.223-2.73.635-3.985a.75.75 0 01.722-.516l.143.001c2.996 0 5.718-1.17 7.734-3.08zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zM12 15a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75v-.008a.75.75 0 00-.75-.75H12z" clip-rule="evenodd" />
                    </svg>

                </div>

                <div class="flex-1">

                    <!-- TITRE -->
                    <h1 class="font-bold text-lg">
                        Alerte de Securite
                    </h1>

                    <!-- MESSAGE -->
                    <p class="text-sm mt-1">
                        Securise votre espace en ajoutant un mot de passe.
                    </p>

                    <!-- FOOTER -->
                    <div class="flex justify-between items-center mt-2">

                        <button @click="openS = true" class="text-lg cursor-pointer underline hover:text-red-600 text-gray-600">
                            Ajouter un mot de passe
                        </button>

                    </div>

                </div>
            </div>

        </div>
    @endif


    @if (session('user_type')=="etudiant")

        @foreach ($this->Notification as $notification)

        <div 
            x-data="{ open: true }" 
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-10"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-10"
            class="relative m-3 p-4 bg-green-100 text-green-800 border-l-4 border-green-500 rounded-xl shadow-md"
        >

            <!-- BOUTON FERMER -->
            <button 
                @click="open = false"
                class="absolute top-2 right-2 text-green-700 hover:text-red-500 transition text-lg font-bold"
                title="Fermer"
            >
                ✕
            </button>

            <!-- CONTENU -->
            <div class="flex items-start gap-3">

                <!-- ICONE -->
                <div class="text-2xl">
                    💰
                </div>

                <div class="flex-1">

                    <!-- TITRE -->
                    <h1 class="font-bold text-lg">
                        Nouvelle transaction
                    </h1>

                    <!-- MESSAGE -->
                    <p class="text-sm mt-1">
                        {{ $notification->message}}
                    </p>

                    <!-- FOOTER -->
                    <div class="flex justify-between items-center mt-2">

                        <span class="text-xs text-gray-600">
                            Transaction enregistrée
                        </span>

                        <span class="text-xs text-gray-500">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>

                    </div>

                </div>
            </div>

        </div>

        @endforeach

    @endif

    <section class="p-3 dark:text-gray-50">
        
        @if (session('user_type') =="etudiant")
        <h1 class="text-2xl font-bold mb-4">Liste des Devoirs</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($this->ListeDevoir as $devoir)
                            <div class="bg-white dark:bg-gray-900 rounded-lg px-4 py-6 {{ $this->isRemis($devoir->code) ? 'opacity-50' : '' }}">
                                <div class="flex flex-row justify-between items-center mb-2">
                                    <div></div> 
                                    <p class="text-sm text-gray-400">{{ $devoir->created_at->diffForHumans() }}</p>
                                </div>

                            <div>
                                
                                <div class="flex flex-row justify-between items-center mb-3">
                                    <p>{{ $devoir->coursRelation?->nom }} 
                                        @if($devoir->created_at->diffInHours(now()) < 24)
                                            <span class="bg-green-600 p-0.5 text-sm rounded-sm text-gray-50">
                                                Nouveau
                                            </span>
                                        @endif
                                    </p>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="mb-3 flex flex-col gap-2">
                                    <h1 class="text-xl font-bold">{{ $devoir->titre }}</h1>
                                    <p>{{ $devoir->description }}</p>
                                </div>

                                <div class="bg-amber-100 px-3 py-5 rounded-sm">
                                    <div class="flex flex-row justify-between text-black mb-3">
                                        <p>Progress</p>
                                        {{-- <p>Rester 3 jours</p> --}}


                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $deadline = \Carbon\Carbon::parse($devoir->dateRemise)->endOfDay();

                                            $diffMinutes = $now->diffInMinutes($deadline, false);

                                            // dd($now);
                                        @endphp

                                        @if ($diffMinutes > 0)

                                            @if ($diffMinutes >= 1440)
                                                @php
                                                    $days = floor($diffMinutes / 1440);
                                                @endphp

                                                <span class="text-green-600">
                                                    {{ $days }} jour{{ $days > 1 ? 's' : '' }} {{ $days > 1 ? 's' : '' }}restant
                                                </span>

                                            @else
                                                @php
                                                    $hours = floor($diffMinutes / 60);
                                                    $minutes = $diffMinutes % 60;
                                                @endphp

                                                <span class="text-yellow-500">
                                                    {{ $hours }}h {{ $minutes }}mn restants
                                                </span>
                                            @endif

                                        @else
                                            <span class="text-red-600">
                                                Délai dépassé
                                            </span>
                                        @endif
                                    </div>
                                    @php
                                        $nombreEt= $this->nombreEtudiant();
                                        $nombreEt_devoir = $this->nombreEtudiantRemttreDevoir($devoir->code);

                                        $pourcentage = ($nombreEt_devoir/$nombreEt)*100;
                                    @endphp

                                    <div class="my-1">
                                        <p class="text-amber-500">Remis: {{ $pourcentage }}% des etudiants </p>
                                    </div>
                                    <div class="rounded-sm p-0.5 w-full bg-amber-500">

                                    </div>
                                </div>

                                <div class="my-3 flex flex-row gap-3">
                                    <button wire:click="downloadDevoir('{{ $devoir->id }}')" class="bg-ugnh-blueFonce p-2 rounded-sm text-white cursor-pointer hover:bg-ugnh-blueHover">Telecharger</button>
                                    <button @if ($this->isRemis($devoir->code)) @disabled(true) @endif wire:click="RemiseDevoirSelect('{{ $devoir->code }}')" @click="open = true" class="border border-ugnh-blueFonce p-2 rounded-sm text-white cursor-pointer hover:bg-ugnh-blueHover">Remis</button>
                                </div>

                                <div  class="flex flex-row justify-between items-center">
                                    <div></div>
                                    <p class="text-green-500 text-sm">
                                        {{-- @php
                                            $this->isRemis($devoir->code)
                                        @endphp --}}
                                        @if ($this->isRemis($devoir->code))
                                            Remis
                                        @else
                                            Pas encore remis
                                        @endif
                                    </p>
                                </div>
                            </div>

                            </div>
                            
                        @endforeach

            </div>
        @endif
    </section>

    <section  x-show="!salleProf" class="p-3 dark:text-gray-50">
        @if (session('user_type') =="professeur")
        <h1 class="text-2xl font-bold mb-5 text-gray-800 dark:text-gray-100">
            Liste de vos salles
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            @foreach ($this->ListeSalleProf as $nomFac)

                <div 
                    class="group cursor-pointer bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
                >

                    <!-- HEADER -->
                    <div class="flex items-center justify-between">

                        <!-- Icon -->
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">

                            <span class="text-xl font-bold text-white">
                                {{ strtoupper(substr($nomFac->codeFac, 0, 1)) }}
                            </span>

                        </div>

                        <!-- Badge -->
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300">
                            Niveau {{ $nomFac->niveau }}
                        </span>

                    </div>

                    <!-- CONTENT -->
                    <div class="mt-5">

                        <h2 class="font-bold text-lg text-gray-800 dark:text-gray-100 group-hover:text-blue-500 transition">
                            {{ $this->nomFac($nomFac->codeFac) }}
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Salle attribuée au professeur
                        </p>

                    </div>

                    <!-- FOOTER -->
                    <div class="mt-6 flex items-center justify-between">

                        <span class="text-xs text-gray-400">
                            Code : {{ $nomFac->codeFac }}
                        </span>

                        <div wire:click="setValue('{{ $nomFac->codeFac }}', '{{ $nomFac->niveau }}')" @click="salleProf = true" class="flex items-center gap-1 text-blue-500 text-sm font-medium">
                            Ouvrir

                            <svg xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-4 h-4 group-hover:translate-x-1 transition">

                                <path stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />

                            </svg>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>
        @endif


    </section>


    @if (session('user_code')=='etudiant')
    <section class="p-3 dark:text-gray-50">
        <div class="flex flex-row justify-between">
            <h1 class="text-2xl font-bold mb-4">Liste des Document </h1>

            <div class="flex items-center gap-1 rounded p-1">

                <!-- ICONE -->
                <div class="bg-ugnh-blueFonce p-1 rounded cursor-pointer border border-amber-500"
                    onclick="document.getElementById('sexe-select').click()">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">

                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>

                </div>

                <!-- SELECT (invisible mais actif) -->
                <select wire:model.live="sexe" id="sexe-select"
                    name="sexe"
                    class="absolute opacity-0 w-10 h-10 cursor-pointer">
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="M">Homme</option>
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="F">Femme</option>
                    
                </select>

            </div>
        </div>

                
        @foreach($this->listeDocument as $session => $documents)

            <!-- TITRE SESSION -->
            <h2 class="text-xl font-bold mb-4 text-green-600 dark:text-green-400">
                Session {{ $session }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                @forelse($documents as $doc)

                    <div class="bg-white dark:bg-gray-900 rounded-lg px-4 py-6 shadow-sm border dark:border-gray-700">

                        <!-- HEADER -->
                        <div class="flex justify-between items-center mb-2">
                            <div></div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $doc->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <!-- COURS -->
                        <div class="flex justify-between items-center mb-3">
                            <p class="font-semibold text-gray-800 dark:text-gray-100">
                                {{ $doc->titre ?? 'Cours inconnu' }}

                                @if($doc->created_at->isToday())
                                    <span class="bg-green-600 px-1 text-xs rounded text-white ml-1">
                                        Nouveau
                                    </span>
                                @endif
                            </p>

                            <div class="cursor-pointer text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                ⋮
                            </div>
                        </div>

                        <!-- CONTENU -->
                        <div class="mb-3 flex flex-col gap-2">
                            {{-- <h1 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $doc->titre }}
                            </h1> --}}

                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Professeur: {{ $this->nomProf($doc->professeurs) }}
                            </p>

                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Cours: {{ $doc->codeCours }}
                            </p>
                        </div>

                        <!-- PROGRESSION -->
                        {{-- <div class="bg-blue-100 dark:bg-blue-900/30 px-3 py-4 rounded-sm">
                            <div class="my-1">
                                <p class="text-blue-600 dark:text-blue-400 text-sm">
                                    Téléchargement: {{ $doc->pourcentage ?? 0 }}%
                                </p>
                            </div>

                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded h-2">
                                <div class="bg-blue-500 h-2 rounded"
                                    style="width: {{ $doc->pourcentage ?? 0 }}%">
                                </div>
                            </div>
                        </div> --}}

                        <!-- ACTIONS -->
                        <div wire:click="downloadDocument('{{$doc->id}}')"  class="mt-4 flex gap-3">
                            <a href=""
                            class="bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white px-3 py-2 rounded text-sm transition">
                                Télécharger
                            </a>
                        </div>

                    </div>

                @empty

                    <div class="col-span-full text-center p-6 bg-gray-50 dark:bg-gray-900 border rounded">
                        <p class="text-gray-500 dark:text-gray-400">
                            Aucun document disponible pour la session {{ $session }}
                        </p>
                    </div>

                @endforelse

            </div>

        @endforeach
                {{-- @endforeach --}}

            {{-- </div> --}}

        {{-- @endif --}}

        {{-- @if ($this->Evenement->isNotEmpty())
            <div class="mt-4 bottom-0 w-full left-0">
                {{ $this->Evenement->links('pagination::tailwind') }}
            </div>
        @endif --}}

    </section>
    @endif

    <div 
        x-show="open"
        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
    >
        <!-- Fond -->
        <div @click="open = false" class="absolute inset-0"></div>

        <!-- Contenu Modal -->
        <div class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-xl shadow-lg p-6 relative z-10 transition-colors">

            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Remise du devoir
                </h2>

                <button 
                    @click="open = false" 
                    class="text-gray-500 hover:text-red-500 dark:text-gray-300 dark:hover:text-red-400">
                    ✕
                </button>
            </div>

            @if (session()->has('success'))
                <div class="mb-3 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mb-3 p-3 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulaire -->
            <form wire:submit="saveDevoir" enctype="multipart/form-data">

                <!-- Code du devoir -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Code du devoir
                    </label>

                    <input 
                        wire:model.live="codeDevoir"
                        type="text" 
                        @readonly(true)
                        class="w-full mt-1 p-2 border rounded-lg 
                            focus:ring focus:ring-blue-200
                            bg-white dark:bg-gray-800 
                            text-gray-800 dark:text-white 
                            border-gray-300 dark:border-gray-700"
                    >
                </div>

                <!-- Fichier -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Fichier du devoir
                    </label>

                    <input 
                        wire:model.live="pdf"
                        type="file" 
                        class="w-full mt-1 p-2 border rounded-lg 
                            bg-white dark:bg-gray-800 
                            text-gray-800 dark:text-white 
                            border-gray-300 dark:border-gray-700"
                    >
                </div>

                <!-- Boutons -->
                <div class="flex justify-end gap-2 mt-5">

                    <button 
                        type="button"
                        @click="open = false"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 
                            text-gray-800 dark:text-white 
                            rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                        Annuler
                    </button>

                    <button 
                        class="px-4 py-2 bg-green-600 text-white 
                            rounded-lg hover:bg-green-700">
                        Envoyer
                    </button>

                </div>
            </form>
        </div>
    </div>





    <div 
        x-show="openS"
        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
    >
        <!-- Fond -->
        <div @click="openS = false" class="absolute inset-0"></div>

        <!-- Contenu Modal -->
        <div class="bg-white dark:bg-gray-800 w-full max-w-lg rounded-xl shadow-lg p-6 relative z-10 transition-colors">

            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Securisation d'espace etudiant
                </h2>

                <button 
                    @click="openS = false" 
                    class="text-gray-500 hover:text-red-500 dark:text-gray-300 dark:hover:text-red-400">
                    ✕
                </button>
            </div>

            @if (session()->has('success'))
                <div class="mb-3 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mb-3 p-3 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulaire -->
            <form wire:submit="savePassword">

                <!-- Code du devoir -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Entrez le mot de passe
                    </label>

                    <input 
                        wire:model.live="password"
                        type="text" 
                        @readonly(false)
                        class="w-full mt-1 p-2 border rounded-lg 
                            focus:ring focus:ring-blue-200
                            bg-white dark:bg-gray-800 
                            text-gray-800 dark:text-white 
                            border-gray-300 dark:border-gray-700"
                    >
                </div>
                <!-- Boutons -->
                <div class="flex justify-end gap-2 mt-5">

                    <button 
                        type="button"
                        @click="openS = false"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 
                            text-gray-800 dark:text-white 
                            rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                        Annuler
                    </button>
                     @if (!$this->isSecure())
                    <button 
                        class="px-4 py-2 bg-green-600 text-white 
                            rounded-lg hover:bg-green-700">
                        Envoyer
                    </button>
                    @endif

                </div>
            </form>
        </div>
    </div>


    <div x-show="salleProf && !remiseDesvoir"  class="h-full w-full dark:text-gray-50">
             @if (session('user_type') =="professeur")
                <div class="flex flex-row gap-2 items-center ">
                    <svg @click="salleProf = false"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer hover:text-red-500">
                    <path fill-rule="evenodd" d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z" clip-rule="evenodd" />
                    </svg>

                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Liste des Devoirs
                    </h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @if ($this->ListeDevoirProf->isNotEmpty())

                                @foreach ($this->ListeDevoirProf as $devoir)

                                    <div class="bg-white dark:bg-gray-900 rounded-lg px-4 py-6">

                                        <div class="flex flex-row justify-between items-center mb-2">
                                            <div></div>

                                            <p class="text-sm text-gray-400">
                                                {{ $devoir->created_at->diffForHumans() }}
                                            </p>
                                        </div>

                                        <div>

                                            <div class="flex flex-row justify-between items-center mb-3">

                                                <p>
                                                    {{ $devoir->coursRelation?->nom }}

                                                    @if($devoir->created_at->diffInHours(now()) < 24)
                                                        <span class="bg-green-600 p-0.5 text-sm rounded-sm text-gray-50">
                                                            Nouveau
                                                        </span>
                                                    @endif
                                                </p>

                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                        class="w-6 h-6">

                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />

                                                    </svg>
                                                </div>

                                            </div>

                                            <div class="mb-3 flex flex-col gap-2">

                                                <h1 class="text-xl font-bold">
                                                    {{ $devoir->titre }}
                                                </h1>

                                                <p>
                                                    {{ $devoir->description }}
                                                </p>

                                            </div>

                                            <div class="bg-amber-100 px-3 py-5 rounded-sm">

                                                <div class="flex flex-row justify-between text-black mb-3">

                                                    <p>Progress</p>

                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $deadline = \Carbon\Carbon::parse($devoir->dateRemise)->endOfDay();

                                                        $diffMinutes = $now->diffInMinutes($deadline, false);
                                                    @endphp

                                                    @if ($diffMinutes > 0)

                                                        @if ($diffMinutes >= 1440)

                                                            @php
                                                                $days = floor($diffMinutes / 1440);
                                                            @endphp

                                                            <span class="text-green-600">
                                                                {{ $days }} jour{{ $days > 1 ? 's' : '' }} restant{{ $days > 1 ? 's' : '' }}
                                                            </span>

                                                        @else

                                                            @php
                                                                $hours = floor($diffMinutes / 60);
                                                                $minutes = $diffMinutes % 60;
                                                            @endphp

                                                            <span class="text-yellow-500">
                                                                {{ $hours }}h {{ $minutes }}mn restants
                                                            </span>

                                                        @endif

                                                    @else

                                                        <span class="text-red-600">
                                                            Délai dépassé
                                                        </span>

                                                    @endif

                                                </div>

                                                @php
                                                    $nombreEt = $this->nombreEtudiantProf();
                                                    $nombreEt_devoir = $this->nombreEtudiantRemttreDevoir($devoir->code);

                                                    $pourcentage = $nombreEt > 0
                                                        ? round(($nombreEt_devoir / $nombreEt) * 100)
                                                        : 0;
                                                @endphp

                                                <div class="my-1">
                                                    <p class="text-amber-500">
                                                        Remis : {{ $pourcentage }}% des étudiants
                                                    </p>
                                                </div>

                                                <!-- Barre de progression -->
                                                <div class="w-full bg-amber-200 rounded-full h-2 overflow-hidden">

                                                    <div
                                                        class="bg-amber-500 h-2 rounded-full transition-all duration-500"
                                                        style="width: {{ $pourcentage }}%">
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="my-3 flex flex-row gap-3">

                                                <button
                                                
                                                    wire:click="selectDevoir('{{ $devoir->code }}')"
                                                    @click ="remiseDesvoir = true"
                                                    class="bg-ugnh-blueFonce p-2 rounded-sm text-white cursor-pointer hover:bg-ugnh-blueHover">

                                                    Voir plus

                                                </button>

                                                <button
                                                    wire:click="deleteDevoir('{{ $devoir->code }}')"
                                                    class="border border-red-500 p-2 rounded-sm text-red-500 cursor-pointer hover:bg-red-500 hover:text-white transition">

                                                    Supprimer

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            @else

                                <div class="text-center py-10 text-gray-400">
                                    Désolé, aucun devoir disponible.
                                </div>

                            @endif
                            

                </div>



                {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"> --}}
                            @if ($this->ListeDocumentProf->isNotEmpty())

                                <div class="flex flex-row justify-between">
                                    <h1 class="text-2xl font-bold mb-4">Liste des Document </h1>

                                    <div class="flex items-center gap-1 rounded p-1">

                                        <!-- ICONE -->
                                        <div class="bg-ugnh-blueFonce p-1 rounded cursor-pointer border border-amber-500"
                                            onclick="document.getElementById('sexe-select').click()">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                            </svg>

                                        </div>

                                        <!-- SELECT (invisible mais actif) -->
                                        <select wire:model.live="sexe" id="sexe-select"
                                            name="sexe"
                                            class="absolute opacity-0 w-10 h-10 cursor-pointer">
                                                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                                    <option class="dark:text-gray-200 dark:bg-gray-600" value="M">Homme</option>
                                                    <option class="dark:text-gray-200 dark:bg-gray-600" value="F">Femme</option>
                                            
                                        </select>

                                    </div>
                                </div>

                                        
                                @foreach($this->ListeDocumentProf as $session => $documents)

                                    <!-- TITRE SESSION -->
                                    <h2 class="text-xl font-bold mb-4 text-green-600 dark:text-green-400">
                                        Session {{ $session }}
                                    </h2>

                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                        @forelse($documents as $doc)

                                            <div class="bg-white dark:bg-gray-900 rounded-lg px-4 py-6 shadow-sm border dark:border-gray-700">

                                                <!-- HEADER -->
                                                <div class="flex justify-between items-center mb-2">
                                                    <div></div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $doc->created_at->diffForHumans() }}
                                                    </p>
                                                </div>

                                                <!-- COURS -->
                                                <div class="flex justify-between items-center mb-3">
                                                    <p class="font-semibold text-gray-800 dark:text-gray-100">
                                                        {{ $doc->titre ?? 'Cours inconnu' }}

                                                        @if($doc->created_at->isToday())
                                                            <span class="bg-green-600 px-1 text-xs rounded text-white ml-1">
                                                                Nouveau
                                                            </span>
                                                        @endif
                                                    </p>

                                                    <div class="cursor-pointer text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                                        ⋮
                                                    </div>
                                                </div>

                                                <!-- CONTENU -->
                                                <div class="mb-3 flex flex-col gap-2">
                                                    {{-- <h1 class="text-lg font-bold text-gray-900 dark:text-white">
                                                        {{ $doc->titre }}
                                                    </h1> --}}

                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        Professeur: {{ $this->nomProf($doc->professeurs) }}
                                                    </p>

                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        Cours: {{ $doc->codeCours }}
                                                    </p>
                                                </div>

                                                <!-- PROGRESSION -->
                                                {{-- <div class="bg-blue-100 dark:bg-blue-900/30 px-3 py-4 rounded-sm">
                                                    <div class="my-1">
                                                        <p class="text-blue-600 dark:text-blue-400 text-sm">
                                                            Téléchargement: {{ $doc->pourcentage ?? 0 }}%
                                                        </p>
                                                    </div>

                                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded h-2">
                                                        <div class="bg-blue-500 h-2 rounded"
                                                            style="width: {{ $doc->pourcentage ?? 0 }}%">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <!-- ACTIONS -->
                                                {{-- <div wire:click="downloadDocument('{{$doc->id}}')"  class="mt-4 flex gap-3">
                                                    <a href=""
                                                    class="bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white px-3 py-2 rounded text-sm transition">
                                                        Télécharger
                                                    </a>
                                                </div> --}}

                                                <button
                                                    wire:click="deleteDocument('{{ $doc->id }}')"
                                                    class="border border-red-500 p-2 rounded-sm text-red-500 cursor-pointer hover:bg-red-500 hover:text-white transition">

                                                    Supprimer

                                                </button>

                                            </div>

                                        @empty

                                            <div class="col-span-full text-center p-6 bg-gray-50 dark:bg-gray-900 border rounded">
                                                <p class="text-gray-500 dark:text-gray-400">
                                                    Aucun document disponible pour la session {{ $session }}
                                                </p>
                                            </div>

                                        @endforelse

                                    </div>

                                @endforeach

                            @else

                                {{-- <div class=" ms-20 py-10 text-gray-400">
                                    Désolé, aucun document disponible.
                                </div> --}}
                                <div class="text-center py-10 text-gray-400">
                                    Désolé, aucun document disponible.
                                </div>

                            @endif
                            

                {{-- </div> --}}
            @endif
    </div>




    <div x-show="remiseDesvoir" class="w-full h-full dark:text-gray-50 p-4">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">

            <div>
                <div class="flex flex-row gap-2 items-center ">
                    <svg @click="remiseDesvoir = false"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer hover:text-red-500">
                    <path fill-rule="evenodd" d="M20.25 12a.75.75 0 01-.75.75H6.31l5.47 5.47a.75.75 0 11-1.06 1.06l-6.75-6.75a.75.75 0 010-1.06l6.75-6.75a.75.75 0 111.06 1.06l-5.47 5.47H19.5a.75.75 0 01.75.75z" clip-rule="evenodd" />
                    </svg>

                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Devoirs remis
                    </h1>
                </div>
                

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Liste des étudiants ayant soumis leur devoir
                </p>
            </div>

            <!-- Search -->
            {{-- <div class="relative w-full sm:w-72">

                <input 
                    type="search"
                    placeholder="Rechercher un étudiant..."
                    class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-3 pl-10 outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                >

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />

                </svg>

            </div> --}}

        </div>

        <!-- TABLE CONTAINER -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <!-- HEAD -->
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">

                        <tr>

                            <th class="text-left px-4 py-4 font-semibold">
                                Matricule
                            </th>

                            <th class="text-left px-4 py-4 font-semibold">
                                Nom
                            </th>

                            <th class="text-left px-4 py-4 font-semibold">
                                Prénom
                            </th>

                            <th class="text-left px-4 py-4 font-semibold">
                                Date remise
                            </th>

                            <th class="text-center px-4 py-4 font-semibold">
                                Fichier
                            </th>

                        </tr>

                    </thead>

                    <!-- BODY -->
                    <tbody>

                        <!-- ITEM -->
                        @foreach ($this->EtudiantRemisDevoir as  $etdRemis)
                            <tr class="border-t border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                                <td class="px-4 py-4 font-medium text-blue-500">
                                {{$etdRemis->matriculeEtudiant}}
                                </td>

                                <td class="px-4 py-4">
                                    {{$etdRemis->etudiant?->nom}}
                                </td>

                                <td class="px-4 py-4">
                                    {{$etdRemis->etudiant?->prenom}}
                                </td>

                                <td class="px-4 py-4 text-gray-500">
                                    {{ $etdRemis->created_at->format('d M Y • h:i A') }}
                                </td>

                                <td class="px-4 py-4">

                                    <div class="flex justify-center">

                                        <button
                                            wire:click="downloadDevoirRemis('{{$etdRemis->id}}')"
                                            class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow-sm transition">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-5 h-5">

                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 14.25v4.125c0 .621-.504 1.125-1.125 1.125H5.625A1.125 1.125 0 014.5 18.375V14.25m15 0l-3.375 3.375M19.5 14.25l-3.375-3.375m0 0V3.75m0 7.125H7.875" />

                                            </svg>

                                            PDF

                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforeach
                        
                        <!-- FIN ITEM -->

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>