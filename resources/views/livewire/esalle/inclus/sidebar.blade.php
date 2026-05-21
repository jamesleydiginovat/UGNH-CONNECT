<aside
    x-data="{
        active: 'home',
        init() {
            this.active = localStorage.getItem('activeMenu') || 'home'
        }
    }"
    x-init="init()"
    @class([
        'flex flex-col h-full overflow-y-scroll no-scrollbar relative bg-ugnh-blueClair transition-all duration-300',
        'dark:bg-gray-900 dark:border-gray-700 dark:border'
    ])
>

    {{-- ================= LOGO ================= --}}
    <div class="flex flex-row items-center px-2 py-2">

        <div class="relative flex flex-row justify-between items-center w-full">
            <a
                @click="open = !open" 
                class="flex items-center gap-3 mt-2"
                href=""
            >
                <img class="min-w-9 h-9 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                <p class="dark:text-gray-300 font-extrabold text-gray-600 whitespace-nowrap">
                    E-SALLE
                </p>
            </a>

            <div class=" text-gray-50">

                <svg @click="open = !open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                </svg>
            </div>
        </div>

        {{-- bouton mobile --}}
        <div @click="open = !open" class="text-red-500 md:hidden cursor-pointer hover:scale-110 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>


    {{-- ================= NAVIGATION ================= --}}
    <div class="flex flex-col justify-between flex-1 mt-6">

        <nav class="flex-1 space-y-2 px-2">

            {{-- ================= ACCUEIL ================= --}}
            <a
                href="{{ session()->has('user_type') ? route('home') : '#' }}"
                @click="active='home'; localStorage.setItem('activeMenu','home')"
                :class="active==='home'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Accueil</span>
            </a>


            {{-- ================= INFOS ================= --}}
            @if (session('user_type') == "etudiant")
            <a
                href="{{ route('informations') }}"
                @click="active='info'; localStorage.setItem('activeMenu','info')"
                :class="active==='info'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Mes informations</span>
            </a>
            @endif


            {{-- ================= SITUATION FINANCIÈRE ================= --}}
            @if (session('user_type') == "etudiant")
            <a
                href="{{ route('situtionsFinancier') }}"
                @click="active='finance'; localStorage.setItem('activeMenu','finance')"
                :class="active==='finance'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Situation financière</span>
            </a>
            @endif


            {{-- ================= COURS ================= --}}
            @if (session('user_type') == "etudiant")
            <a
                href="{{ route('coursHoraire') }}"
                @click="active='cours'; localStorage.setItem('activeMenu','cours')"
                :class="active==='cours'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Cours et Horaire</span>
            </a>
            @endif


            {{-- ================= NOTES ================= --}}
            @if (session('user_type') == "etudiant")
            <a
                href="{{ route('notes') }}"
                @click="active='notes'; localStorage.setItem('activeMenu','notes')"
                :class="active==='notes'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Notes</span>
            </a>
            @endif


            {{-- ================= CHAT ================= --}}
            @if (session('user_type') == "etudiant" || session('user_type') == "professeur")
            <a
                href="{{ route('chatGroup') }}"
                @click="active='chat'; localStorage.setItem('activeMenu','chat')"
                :class="active==='chat'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Chat Group</span>
            </a>
            @endif


            {{-- ================= PARAMÈTRES ================= --}}
            {{-- <a
                href=""
                @click="active='settings'; localStorage.setItem('activeMenu','settings')"
                :class="active==='settings'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                class="flex items-center p-2 rounded-lg transition-all duration-200 hover:scale-[1.02]"
            >
                <span class="mx-8 text-sm font-medium">Paramètres</span>
            </a> --}}

        </nav>


        {{-- ================= PROFIL ================= --}}
        <div class="mt-6 p-2 flex items-center justify-between">

            <div class="flex items-center gap-2">
                {{-- <img
                    class="w-8 h-8 rounded-full object-cover"
                    src="{{ Storage::url('photosEtudiants/'.session('photo')) }}"
                > --}}

                <span class="text-sm text-gray-700 dark:text-gray-200">
                    @if (session('user_type')=='professeur')
                         {{ $this->nomProf(session('user_code')) }}
                    @else
                         {{ $this->nomEtudiant(session('user_code')) }}
                    @endif
                   
                </span>
            </div>

            <a href="{{ route('esalle.logout') }}"
               class="hover:text-red-500 transition rotate-180 text-gray-500 dark:text-gray-400"
            >
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>

            </a>

        </div>

    </div>
</aside>