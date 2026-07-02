<section>
<section @class([
        'p-3 flex flex-col gap-3 h-auto',
        'lg:flex-row'
    ])>
        <section @class([
            'w-full flex flex-col gap-3',
            'lg:w-1/2'
        ])>
            
            <div @class([
            'flex sm:flex-row flex-col w-full gap-3'
            ])>

                <div @class([
                    'p-3 rounded bg-white shadow-xs w-full sm:w-1/2 flex flex-row items-center justify-between',
                    'dark:border-gray-600 dark:border dark:bg-gray-900'
                ])>

               
                    <div @class(['flex flex-col  items-center  gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row gap-2 ',
                            'dark:text-gray-200'
                        
                        ])> 
                            <div class="bg-ugnh-blueFonce p-1 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-ugnh-blueClair w-6 h-6">
                            <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                            <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                            <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                            </svg>
                            </div>
                            Etudiant
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-200'
                            ])>
                            {{ $this->nombreEtudiant }}</p>
                    </div>


                    <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 rounded p-1">

                        <!-- ICONE -->
                        <div class="bg-ugnh-blueFonce p-1 rounded cursor-pointer"
                            onclick="document.getElementById('sexe-select').click()">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>

                        </div>

                        <!-- SELECT (invisible mais actif) -->
                        <select wire:model.live="codeFac" id="codeFac"
                            name="sexe"
                            class="absolute opacity-0 w-10 h-10 cursor-pointer">
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                            @foreach ($this->Facultes as $faculte)
                                   <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                            @endforeach
                        </select>

                    </div>

                    

                </div>




                <div @class([
                    'p-3 rounded bg-white shadow-xs w-full sm:w-1/2 flex flex-row items-center justify-between',
                    'dark:border-gray-600  dark:border dark:bg-gray-900'
                ])>
                    <div @class(['flex flex-col items-center gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row items-center  gap-2 ',
                            'dark:text-gray-200'
                        
                        ])> 
                            <div class="bg-green-500 p-1 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-100">
                            <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                            </svg>

                            </div>
                            Utilisateur
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-200'
                            ])>
                            {{ $this->nombreUtilisateur }}</p>
                    </div>

                    <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 rounded p-1">

                        <!-- ICONE -->
                        <div class="bg-ugnh-blueFonce p-1 rounded cursor-pointer"
                            onclick="document.getElementById('sexe-select').click()">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>

                        </div>

                        <!-- SELECT (invisible mais actif) -->
                        <select wire:model.live="status" id="sexe-select"
                            name="sexe"
                            class="absolute opacity-0 w-10 h-10 cursor-pointer">
                                   <option class="dark:text-gray-200 dark:bg-gray-600" value="">Toute</option>
                                   <option class="dark:text-gray-200 dark:bg-gray-600" value="1">En ligne</option>
                                   <option class="dark:text-gray-200 dark:bg-gray-600" value="0">Hors ligne</option>
                        </select>

                    </div>
                    

                </div>

                

            </div>




            <div @class([
            'flex sm:flex-row flex-col  w-full gap-3'
            ])>

                <div @class([
                    'p-3 rounded bg-white  shadow-xs w-full sm:w-1/2 flex flex-row items-center justify-between',
                    'dark:border-gray-600 dark:border dark:bg-gray-900'
                ])>
                    <div @class(['flex flex-col  items-center   gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row items-center gap-2 ',
                            'dark:text-gray-200'
                        
                        ])> 
                            <div class="bg-yellow-500 p-1 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-yellow-50">
                            <path d="M16.5 6a3 3 0 00-3-3H6a3 3 0 00-3 3v7.5a3 3 0 003 3v-6A4.5 4.5 0 0110.5 6h6z" />
                            <path d="M18 7.5a3 3 0 013 3V18a3 3 0 01-3 3h-7.5a3 3 0 01-3-3v-7.5a3 3 0 013-3H18z" />
                            </svg>
                            </div>
                            Professeurs
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-200'
                            ])>
                            {{ $this->nombreProfesseur }}</p>
                    </div>

                    <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 rounded p-1">

                        <!-- ICONE -->
                        <div class="bg-ugnh-blueFonce p-1 rounded cursor-pointer"
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



                <div @class([
                    'p-3 rounded bg-white shadow-xs w-full sm:w-1/2 flex flex-row items-center justify-between',
                    'dark:border-gray-600 dark:border dark:bg-gray-900'
                ])>
                    <div @class(['flex flex-col  items-center  gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row items-center gap-2 ',
                            'dark:text-gray-200'
                        
                        ])> 
                            <div class="bg-red-500 p-1 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-red-100">
                                <path d="M12.378 1.602a.75.75 0 00-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03zM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 00.372-.648V7.93zM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 00.372.648l8.628 5.033z" />
                                </svg>

                            </div>
                            
                            Faculte
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-200'
                            ])>
                            {{ $this->nombreFaculte }}</p>
                    </div>

                    <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 rounded p-1">

                        <!-- ICONE -->
                        <div class="bg-ugnh-blueFonce p-1 rounded cursor-pointer"
                            onclick="document.getElementById('sexe-select').click()">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>

                        </div>

                        <!-- SELECT (invisible mais actif) -->
                        <select disabled id="sexe-select"
                            name="sexe"
                            class="absolute opacity-0 w-10 h-10 cursor-pointer">
                             @foreach ($this->Facultes as $faculte)
                                   <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                            @endforeach
                        </select>

                    </div>
                    

                </div>


            </div>


            <div @class([
                'w-full bg-white shadow-xs rounded h-full overflow-hidden',
                'dark:border-gray-900 dark:border dark:bg-gray-900'
            ])>
                <livewire:pages.course-by-faculty-chart />
            </div>

        </section>


        <section @class([
            'w-full flex flex-col gap-3',
            'lg:w-1/2'
        ])>

            <div @class([
                'flex flex-col sm:flex-row gap-3 w-full '
            ])>

                <div @class([
                    'p-3 rounded bg-white  shadow-xs w-full sm:w-1/2 h-100 bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:border dark:bg-gray-900'
                ])>
                        <livewire:pages.money-per-month-chart />
                </div>

                <div @class([
                    'p-3 rounded bg-white  shadow-xs w-full sm:w-1/2 overflow-x-auto no-scrollbar h-100',
                    'dark:border-gray-600 dark:border dark:bg-gray-900'
                ])>
                 <h1 @class(['text-gray-600 px-3 font-bold flex flex-row gap-1', 'dark:text-gray-200'])> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bg-ugnh-blueFonce p-1 rounded-full text-gray-50 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                </svg>
                Cours du jour
                </h1>


                 <table @clas(['w-full'])>

                        <thead @class(['border-b border-b-[#ccc]', 'dark:border-gray-600'])>
                            <tr>
                                <th @class(['text-start font-normal text-gray-800 sm:w-50 w-full py-3 px-3 text-sm', 'dark:text-gray-200'])>Cours</th>

                                <th @class(['text-start font-normal text-gray-800  sm:w-50 py-3 px-3  text-sm' , 'dark:text-gray-200'])>Professeur</th>

                                <th @class(['text-start font-normal text-gray-800 sm:w-20 py-3 px-3 text-sm' , 'dark:text-gray-200'])>Heure</th>

                                {{-- <th @class(['text-start font-normal text-gray-800  w-30 py-3 px-3 text-sm'])>Date</th>

                                <th @class(['text-start font-normal text-gray-800  w-20 py-3 px-3 text-sm'])>Heure</th> --}}
                            </tr>
                        </thead>


                        <tbody >
                            @foreach ($this->CoursDuJours as $cours)
                                <tr @class(['border-b border-b-[#ccc] hover:bg-ugnh-blueClair', 'dark:border-gray-600 dark:hover:bg-gray-800'])>
                                    <th @class(['text-start font-normal  py-2 px-3 text-sm text-gray-600', 'dark:text-gray-300'])>
                                        <p>{{ $cours->cours }}</p>
                                        <span @class(['text-[12px]'])>{{ $cours->faculte->nom ?? '---'}} ({{ $cours->niveau }}) </span>
                                    </th>

                                    <th @class(['text-start font-normal text-sm py-2 px-3 text-gray-600', 'dark:text-gray-300'])>
                                        {{ $this->nomProf($cours->prof->codeProf) }}
                                    </th>

                                    {{-- <th @class(['font-normal py-2 px-3 text-start text-sm text-gray-600'])>
                                        12/02/2026
                                    </th> --}}

                                    <th @class(['font-normal py-2 px-3 text-start text-sm text-gray-600', 'dark:text-gray-300'])>
                                        {{ \Carbon\Carbon::parse($cours->heure_debut)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($cours->heure_fin)->format('H:i') }}
                                    </th>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                </div>

            </div>



            <div @class([
                'flex flex-col p-3 rounded shadow-xs gap-3 h-full bg-white dark:bg-gray-900 w-full dark:border-gray-600 dark:border'
            ])>

            <div @class([
                ' bg-white  w-full h-auto',
                ' dark:bg-gray-900'
            ])>
            <h1 @class(['text-gray-600 px-3  pb-3 font-bold border-b border-[#ccc] flex flex-row gap-2', 'dark:text-gray-200 dark:border-gray-600'])>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bg-ugnh-blueFonce p-1 rounded-full text-gray-50 w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
            </svg>
            Acces Rapide
            </h1>

                @php
                    $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des historiques');
                @endphp

                <a href="{{ $hasPermission ? Route('historique') : '#' }}">
                <div @class(['border-b border-[#ccc] hover:bg-ugnh-blueClair','dark:border-gray-600 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>
                    <h1 @class(['text-start font-normal text-sm py-2 px-3 text-gray-600', 'dark:text-gray-300'])>Historique des utilisateur</h1>
                </div>
                </a>

                @php
                    $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des finances');
                @endphp

                <a href="{{ $hasPermission ? Route('gestion-des-finances') : '#' }}">
                <div @class(['border-b border-[#ccc] hover:bg-ugnh-blueClair', 'dark:border-gray-600 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>
                    <h1 @class(['text-start font-normal text-sm py-2 px-3 text-gray-600', 'dark:text-gray-300 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>Etat financiere</h1>
                </div>
                </a>

                @php
                    $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des dossiers et archives');
                @endphp

                <a href="{{ $hasPermission ? Route('gestion-des-dossiers') : '#' }}">
                <div @class(['border-b border-[#ccc] hover:bg-ugnh-blueClair', 'dark:border-gray-600 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>
                    <h1 @class(['text-start font-normal text-sm py-2 px-3 text-gray-600', 'dark:text-gray-300 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>Archive des l'UGNH</h1>
                </div>
                </a>


                <div @class(['border-b border-[#ccc] hover:bg-ugnh-blueClair', 'dark:border-gray-600 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>
                    <h1 @class(['text-start font-normal text-sm py-2 px-3 text-gray-600', 'dark:text-gray-300 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>Plateforme E-salle</h1>
                </div>

            </div>

            </div>

        </section>

    </section>


            @php
                $role = Auth::user()->roles->first()->nom ?? '';

                $isAdmin = $role == "Administrateur";
                $isSecretaireGenerale = $role == "Secrétaire générale";
                $doyenFaculte = $role == "Doyen de faculté";
            @endphp
            @if ($isAdmin)
            <div @class([
                'bg-white shadow-xs rounded  mx-3 mb-3 m overflow-hidden p-3',
                'dark:border-gray-900 dark:border dark:bg-gray-900'
             ])>
                <div @class(['flex flex-row items-center justify-between'])>
                    <h1 @class([
                        'text-gray-600 px-3 font-bold flex flex-row gap-2',
                        'dark:text-gray-200'
                    
                    ])>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bg-ugnh-blueFonce p-1 rounded-full text-gray-50 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z" />
                    </svg>

                    Actions recentes</h1>
                </div>


                
                <div @class([
                    ' overflow-x-auto overflow-y-scroll no-scrollbar',
                    
                ])>
                    <table @class(['w-full '])>

                        <thead @class([
                            'border-b border-[#ccc] ',
                            'dark:border-gray-600 '
                            ])>
                            <tr>
                                <th @class([
                                    'text-start font-normal text-gray-800 w-50 py-3 px-3 text-sm',
                                    'dark:text-gray-200'
                                ])>Utilisateur</th>

                                <th @class(['text-start font-normal text-gray-800  w-20 py-3 px-3  text-sm', 'dark:text-gray-200'])>Status</th>

                                <th @class(['text-start font-normal text-gray-800 w-70 py-3 px-3 text-sm', 'dark:text-gray-200'])>Description</th>

                                <th @class(['text-start font-normal text-gray-800  w-30 py-3 px-3 text-sm', 'dark:text-gray-200'])>Date</th>

                                <th @class(['text-start font-normal text-gray-800  w-20 py-3 px-3 text-sm', 'dark:text-gray-200'])>Heure</th>
                            </tr>
                        </thead>


                        <tbody >
                            

                            {{-- @php
                                dd($this->okok());
                            @endphp --}}
                            @foreach ($this->ActionRecentes as $action)
                                <tr @class(['border-b border-b-[#ccc] hover:bg-ugnh-blueClair','dark:border-gray-600 dark:hover:bg-gray-800' ])>
                                    <th @class(['text-start font-normal  py-2 px-3 text-sm text-gray-600', 'dark:text-gray-300'])>
                                        <p>{{ $action->code }}</p>
                                        <span @class(['text-[12px]'])>{{ $this->Fonction($action->code) }}</span>
                                    </th>

                                    
                                    
                                    <th @class(['text-center font-normal text-sm text-gray-600', 'dark:text-gray-400'])>
                                        @if ($this->isOnlineOrNot($action->code) == '1')
                                            <div class="text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                En ligne
                                            </div>
                                        @else
                                            <div class="text-sm font-normal rounded-full text-red-500 gap-x-2 bg-red-100/60 dark:bg-gray-800">
                                                Hors ligne
                                            </div>
                                        @endif
                                    </th>


                                    <th @class(['font-normal py-2 px-3 text-start text-sm text-gray-600', 'dark:text-gray-300'])>
                                        {{ $action->action }}
                                    </th>


                                    <th @class(['font-normal py-2 px-3 text-start text-sm text-gray-600', 'dark:text-gray-300'])>
                                       {{ $action->created_at->format('d F Y') }}
                                    </th>

                                    <th @class(['font-normal py-2 px-3 text-start text-sm text-gray-600', 'dark:text-gray-300'])>
                                        {{ $action->created_at->format('H:i:s') }}
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            @endif


            <div @class([
                'flex flex-col mx-3 gap-3'
            ])>

                <div @class([
                'flex flex-row gap-3 '
                ])>

                    <div @class([
                        'p-3 rounded border border-gray-200 shadow-xs w-full bg-white',
                        'dark:border-gray-600 dark:bg-gray-900'
                    ])>
                    <h1 @class(['text-gray-600 px-3 font-bold flex flex-row gap-2 ', 'dark:text-gray-200'])>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" bg-ugnh-blueFonce rounded-full text-gray-50 p-1 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Temps de connexion
                    </h1>

                        <p id="timer" @class(['text-center font-normal text-2xl md:text-5xl py-10 px-2 text-gray-600', 'dark:text-gray-400'])>0hr:35mn <br/> 54s</p>

                    </div>


                    <script>
                    function startTimer(startTime) {

                        const start = new Date(startTime).getTime();

                        if (isNaN(start)) {
                            console.error("Date invalide :", startTime);
                            return;
                        }

                        setInterval(() => {
                            const now = Date.now();
                            const diff = now - start;

                            const seconds = Math.floor(diff / 1000);
                            const hours = Math.floor(seconds / 3600);
                            const minutes = Math.floor((seconds % 3600) / 60);
                            const secs = seconds % 60;

                            document.getElementById("timer").innerHTML =
                                String(hours).padStart(2, '0') + ":" +
                                String(minutes).padStart(2, '0') + ":" +
                                String(secs).padStart(2, '0');

                        }, 1000);
                    }

                    document.addEventListener('livewire:init', () => {
                        startTimer(@json($loginTime));
                    });
                    </script>

                    {{-- <div @class([
                        'p-3 rounded border border-gray-200 shadow-xs w-1/2 h-43 bg-ugnh-blueFonce',
                        'dark:bg-gray-700 dark:border-gray-600' 
                    ])>
                    <h1 @class(['text-gray-200 px-3 font-bold flex flex-row gap-2 ', 'dark:text-gray-200'])>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" bg-ugnh-blueClair  rounded-full p-1 text-gray-600 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                        Calendrier</h1>


                    </div> --}}
                </div>


                    
                

            </div>

    </section>