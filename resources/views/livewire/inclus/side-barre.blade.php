<aside 
x-init="init()"
@class([
'flex flex-col h-full  overflow-y-scroll  no-scrollbar relative bg-white',
'',
'dark:bg-gray-900 dark:border-gray-700 dark:border dark:border-gray-700'
])
>

    {{-- logo --}}
    <div class="flex flex-row items-center justify-between">
        <div class="relative">
        <a 
        @class([
        'flex items-center gap-3 mt-2'
        ])  
        href="{{ route('dashboard-general') }}"
        >
            <img class="min-w-9 h-9 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
            <p :class="open ? 'w-0' : ''" class="dark:text-gray-300 font-extrabold text-gray-600 whitespace-nowrap" >UGNH-CONNECT</p>
            
        </a>
        <span x-show="!open" class="text-sm italic absolute top-9 right-0 text-end text-gray-50 rounded-sm p-0.5 bg-gray-600">{{ $anneAccademiqueActive->libelle }}</span>
        </div>
        {{-- fin logo --}}


        <div @click="open = !open" class=" text-red-500 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>

        </div>
    </div>
    



    <div 
    @class([
        'flex flex-col justify-between flex-1 mt-6'
    ])
    >
        {{-- nav --}}
        <nav 
        @class([
            'flex-1 space-y-2'
        ])
        >

             {{-- ------ --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des annnées accademiques');
            @endphp
            <a
                @click="active='Gesttion Annee accademique'; localStorage.setItem('activeMenu','Gesttion Annee accademique')"
                :class="active==='Gesttion Annee accademique'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('annees-accademique') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Annee accademique
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------ --}}


            {{-- ------ --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Tableau de bord général');
            @endphp
            <a
                @click="active='Tableau de bord'; localStorage.setItem('activeMenu','Tableau de bord')"
                :class="active==='Tableau de bord'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('dashboard-general') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Tableau de bord
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------ --}}



            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des personnels');
            @endphp

            <a
                @click="active='Gestion Personnel'; localStorage.setItem('activeMenu','Gestion Personnel')"
                :class="active==='Gestion Personnel'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-personnels') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                    Personnel
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}
            

            




            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des utilisateurs et rôles');
            @endphp

            <a
                @click="active='Gestion des Utilisateurs'; localStorage.setItem('activeMenu','Gestion des Utilisateurs')"
                :class="active==='Gestion des Utilisateurs'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-utilisateurs') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                    Utilisateurs et roles
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}





            
            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des étudiants');
            @endphp

            <a
                @click="active='Gestion des Etudiants'; localStorage.setItem('activeMenu','Gestion des Etudiants')"
                :class="active==='Gestion des Etudiants'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-etudiants') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                    Etudiants
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}




            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des facultés et des décanats');
            @endphp

            <a
                @click="active='Gestion Faculte'; localStorage.setItem('activeMenu','Gestion Faculte')"
                :class="active==='Faculte'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-facultes') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                    Faculte et des decanats
                </span>

                
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}




            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des professeurs');
            @endphp

            <a
                @click="active='Gestion des Professeurs'; localStorage.setItem('activeMenu','Gestion des Professeurs')"
                :class="active==='Gestion des Professeurs'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-professeurs') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Professeurs
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}



            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des cours et programmes');
            @endphp

            <a
                @click="active='Gestion des Cours'; localStorage.setItem('activeMenu','Gestion des Cours')"
                :class="active==='Gestion des Cours'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-cours') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Cours et programmes
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}





            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des finances');
            @endphp

            <a
                @click="active='Gestion des Paiements'; localStorage.setItem('activeMenu','Gestion des Paiements')"
                :class="active==='Gestion des Paiements'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-finances') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Finances
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}




            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des évaluations et résultats');
            @endphp
            <a
                @click="active='Evaluations et resultats'; localStorage.setItem('activeMenu','Evaluations et resultats')"
                :class="active==='Evaluations et resultats'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-notes') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Evaluations et resultats
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}

            {{--  --}}
            
            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des évaluations et résultats');
            @endphp

            <a
                @click="active='Validation des resultats'; localStorage.setItem('activeMenu','Validation des resultats')"
                :class="active==='Validation des resultats'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('validationNotes') : '#' }}"
            >
                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                </svg> --}}

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>



                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Validation des resultats
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}



            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des dossiers et archives');
            @endphp

            <a
                @click="active='Gestion des Dossiers'; localStorage.setItem('activeMenu','Gestion des Dossiers')"
                :class="active==='Gestion des Dossiers'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-dossiers') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                   Dossiers et archives
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}





            {{-- ------- --}}
            @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des historiques');
            @endphp

            <a
                @click="active='Historique'; localStorage.setItem('activeMenu','Historique')"
                :class="active==='Historique'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('historique') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                  Historique
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a>
            {{-- ------- --}}




            

            {{-- ------- --}}
            {{-- @php
                $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des historiques');
            @endphp

            <a
                @click="active='Parametre'; localStorage.setItem('activeMenu','Parametre')"
                :class="active==='Parametre'
                    ? 'bg-ugnh-blueFonce text-white shadow-md'
                    : 'text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800'"
                @class([
                    'relative flex items-center p-2 text-gray-600 transition-colors duration-300 transform ps-3',
                    'dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-200',
                    'hover:bg-ugnh-blueFonce hover:text-gray-50' => $hasPermission,
                    'opacity-70 cursor-not-allowed' => !$hasPermission,
                ])
                href="{{ $hasPermission ? Route('gestion-des-finances') : '#' }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

                <span
                    :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'"
                    class="mx-8 text-sm font-medium whitespace-nowrap transition-all duration-1000 ease-in-out"
                >
                  Parametre
                </span>

                {{-- Icône cadenas pour indiquer que c’est verrouillé --}}
                {{-- @if(!$hasPermission)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-2 text-gray-500 absolute right-2 top-3">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                    </svg>
                @endif
            </a> --}}
            {{-- ------- --}}

        </nav>

        <div class="mt-6">
            {{-- <div class="p-3 bg-gray-100 rounded-lg dark:bg-gray-800">
                <h2 class="text-sm font-medium text-gray-800 dark:text-white">New feature availabel!</h2>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus harum officia eligendi velit.</p>

                <img class="object-cover w-full h-32 mt-2 rounded-lg" src="https://images.unsplash.com/photo-1658953229664-e8d5ebd039ba?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&h=1374&q=80" alt="">
            </div> --}}

            <div @class([
                'flex items-center justify-between mt-6 p-2 mb-2'
            ])>
                <a @class([
                    'relative flex items-center gap-x-2'
                ]) href="#">
                    <img class="object-cover rounded-full h-7 w-7 absolute" src="{{ Storage::url("profileUtilisateur/".Auth::user()->photo) }}" alt="avatar" />
                    <span :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'" class="text-sm mx-8 font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap transition-all duration-1000 ease-in-out"> 
                        @if (Auth::check())
                        <p>{{ Auth::user()->personnel->nom." ".Auth::user()->personnel->prenom }}</p>
                        @endif
                    </span>
                </a>
                
                <a href="{{Auth::check() ? route('logout') : '#' }}" @class([
                    'text-gray-500 transition-colors duration-200 rotate-180 hover:text-blue-500 ',
                    'dark:text-gray-400 dark:hover:text-blue-400'
                ]) 
                :class="open ? 'md:opacity-0 opacity-100' : 'opacity-0 md:opacity-100'" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</aside>
