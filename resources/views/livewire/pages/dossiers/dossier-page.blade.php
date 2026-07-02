<section class="p-3 m-3 bg-white dark:bg-gray-900">
    <div class=" right-0 top-0 ">
    <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 '])
        @click="tableSlide = !tableSlide"
        >
            <div></div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
    </div>

    </div>

    @if($this->DossierEtudiant)
    <section>
        <div class="flex flex-row justify-between items-center border-b border-gray-600 pb-3 dark:text-gray-200 ">
            <div>
                <h1 class="text-2xl">{{ $this->DossierEtudiant->nom}} {{ $this->DossierEtudiant->prenom }}</h1>
                <p><span class="font-bold">Faculte:</span> {{ $this->getFaculteEtudiant($this->DossierEtudiant->matricule)->faculte->nom ?? '' }}</p>
                <p><span class="font-bold">Niveau:</span> {{ $this->DossierEtudiant->niveau}}</p>
                <p class="bg-ugnh-blueFonce p-1 rounded-2xl text-white text-center">
                    {{ $this->DossierEtudiant->status}}</p>
            </div>

            <div class="w-20 h-20 bg-ugnh-blueFonce p-2 overflow-hidden rounded-full">
                @if ($this->DossierEtudiant->photo)
                    <img class="w-20 h-20 object-cover" src="{{ Storage::url("photosEtudiants/". $this->DossierEtudiant->photo)}}" alt="" srcset="">
                @endif
            </div>
        </div>


        <div class="my-3 border-b border-gray-600 pb-3">
            <div class="bg-white dark:bg-gray-700 p-3 mb-3">

                <!-- Titre -->
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200  py-5">
                    Informations personnelles
                </h1>

                <!-- Contenu -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200">Nom :</span> {{ $this->DossierEtudiant->nom}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Prénom :</span> {{ $this->DossierEtudiant->prenom}}</p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Sexe :</span> {{ $this->DossierEtudiant->sexe}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Date de naissance :</span> {{ $this->DossierEtudiant->dateNaissance}}</p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">CIN/NIF :</span> {{ $this->DossierEtudiant->nif_cin}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Condition matrimoniale :</span> {{ $this->DossierEtudiant->conditionMatrimoniale}}</p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Adresse :</span> {{ $this->DossierEtudiant->adresse}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Téléphone :</span> {{ $this->DossierEtudiant->telephone}}</p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Lieu de naissance :</span> {{ $this->DossierEtudiant->lieuNaissance}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Groupe sanguin :</span> {{ $this->DossierEtudiant->groupeSanguin}}</p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Occupation actuelle :</span> {{ $this->DossierEtudiant->occupationAcctuelle}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Lieu de travail :</span> {{ $this->DossierEtudiant->lieuDeTravail}}</p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Responsable :</span> {{ $this->DossierEtudiant->nomPrenomPersonneR}}</p>
                    <p><span class="font-semibold text-gray-900 dark:text-gray-200 ">Téléphone responsable :</span> {{ $this->DossierEtudiant->telephonePersonneR}}</p>

                    <p>
                        <span class="font-semibold text-gray-900 dark:text-gray-200 ">Lien :</span> 
                        <a href="#" class="text-blue-600 hover:underline">{{ $this->DossierEtudiant->lien}}</a>
                    </p>

                    <p><span class="font-semibold text-gray-900 dark:text-gray-200">Référé par :</span> {{ $this->DossierEtudiant->PersonneReferences}}</p>

                </div>
            </div>


            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200  py-5">
                 Niveau d'etude
            </h1>


            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-700 overflow-hidden">
                    
                    <!-- Header -->
                    <thead class="bg-gray-100 dark:border-b dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-gray-700 uppercase text-sm">
                        <tr>
                            <th class="py-3 px-6 text-left">Niveau</th>
                            <th class="py-3 px-6 text-left">Année</th>
                            <th class="py-3 px-6 text-left">Établissement</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="text-gray-600 dark:border-b dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm">
                        
                        <tr class="border-b border-gray-400 hover:bg-gray-50  dark:hover:bg-gray-600 transition">
                            <td class="py-4 px-6 font-medium">{{ $this->DossierEtudiant->niveauBac}}</td>
                            <td class="py-4 px-6">{{ $this->DossierEtudiant->anneeBac}}</td>
                            <td class="py-4 px-6">{{ $this->DossierEtudiant->etablissmentBac}}</td>
                        </tr>

                        {{-- <tr class="border-b border-gray-400 hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">Bac II</td>
                            <td class="py-4 px-6">2023 - 2024</td>
                            <td class="py-4 px-6">Université X</td>
                        </tr> --}}

                    </tbody>
                </table>
            </div>





            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200  py-5">
                 Etude superieures
            </h1>


            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-700 overflow-hidden">
                    
                    <!-- Header -->
                    <thead class="bg-gray-100 dark:bg-gray-700  dark:border-b dark:border-gray-600 text-gray-700 dark:text-gray-200 uppercase text-sm">
                        <tr>
                            <th class="py-3 px-6 text-left">Etablissement</th>
                            <th class="py-3 px-6 text-left">Année</th>
                            <th class="py-3 px-6 text-left">Discipline</th>
                            <th class="py-3 px-6 text-left">Niveau</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="text-gray-600 dark:text-gray-200 text-sm">
                        
                        <tr class="border-b border-gray-400 dark:border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                            <td class="py-4 px-6 font-medium">{{ $this->DossierEtudiant->etablissementES}}</td>
                            <td class="py-4 px-6">{{ $this->DossierEtudiant->anneeES}}</td>
                            <td class="py-4 px-6">{{ $this->DossierEtudiant->disciplineES}}</td>
                            <td class="py-4 px-6">{{ $this->DossierEtudiant->niveauES}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>


        </div>




        <div class="my-3 border-b border-gray-600 pb-3">
            <div class="bg-white dark:bg-gray-700 p-3  dark:text-gray-200 mb-3">
                 <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200  py-5">
                 Information academique
            </h1>

            <div x-data="{ open: null }" class="space-y-4">

            @foreach ( $this->DossierFinanciereEtudiant as $anneAcademique => $sessions)

                <div class="bg-white dark:bg-gray-600 dark:text-gray-200 rounded-xl shadow">
                
                    <!-- Header -->
                    @php
                        $this->anneAcademique= $anneAcademique;
                        
                    @endphp

                    <button
                         wire:click="setAnneAcademique('{{ $anneAcademique }}')"
                        @click="open === '{{ $anneAcademique }}' ? open = null : open = '{{ $anneAcademique }}'"
                        class="w-full flex justify-between items-center p-4 font-semibold text-gray-800 dark:text-gray-200"
                    >
                        <span>Année académique : {{ $anneAcademique }}</span>
                        <span x-text="open === '{{ $anneAcademique }}' ? '-' : '+'"></span>
                    </button>

                    <!-- Contenu -->
                    <div x-show="open === '{{ $anneAcademique }}'" x-transition class="p-4 border-t text-gray-600 dark:text-gray-200" >
                        <div>
                            <p>
                                <span class="font-bold">Faculte: </span>
                                {{ $this->getFaculteEtudiant($this->DossierEtudiant->matricule)->faculte->nom ?? '' }}
                            </p>
                            <p><span class="font-bold">Niveau: </span>I</p>

                            <div x-data="{ openSession: null }" class="space-y-4">

                                <!-- SESSION I -->
                                @foreach ($sessions as $session=> $paiements )
                                    
                                
                                <div class="bg-white dark:bg-gray-500 rounded-xl shadow">

                                    <!-- Header -->
                                    <button 
                                        @click="openSession === '{{ $session }}' ? openSession = null : openSession = '{{ $session }}'"
                                        class="w-full flex justify-between items-center p-4 font-bold text-gray-800 dark:text-gray-200"
                                    >
                                        <span>Session {{ $session }}</span>
                                        <span x-text="openSession === 1 ? '-' : '+'"></span>
                                    </button>

                                    <!-- Contenu -->
                                    <div x-show="openSession === '{{ $session }}'" x-transition class="p-4 border-t">

                                        <!-- TU COLLES ICI TOUT TON CONTENU SESSION I -->
                                        <div>
                            
                                                <h1 class="text-xl mt-5 font-bold text-center ">Session {{ $session }}</h1>

                                                <div class="mt-5">
                                                    <h1 class="text-xl font-bold">Informations financières</h1>

                                                    <div class="w-full rounded-sm bg-gray-900 text-white flex flex-row ">
                                                        <div class="w-1/3 border text-center border-gray-600 relative">
                                                            <p>Versement 1</p>
                                                        </div>

                                                        <div class="w-1/3 border text-center border-gray-600">
                                                            <p>Versement 2</p>
                                                        </div>

                                                        <div class="w-1/3 border text-center border-gray-600">
                                                            <p>Versement 3</p>
                                                        </div>

                                                    </div>
                                                    @foreach ($paiements as $paiement)
                                                        
                                                    
                                                    <div class="w-full rounded-sm bg-green-200 flex flex-row dark:text-gray-700 ">
                                                        <div class="w-1/3 h-10 p-2 border-s border-r border-gray-600 relative">

                                                            <div style="width: {{ round((($paiement->premierVersement/$paiement->prixVersement1) *100), 2)}}%;" class="bg-green-400 h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                                                                <p class="absolute font-bold">+{{ $paiement->premierVersement }}<br></p>
                                                                <p class="text-sm  absolute bottom-0">{{ round((($paiement->premierVersement/$paiement->prixVersement1) *100), 2)}}%</p>
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="w-1/3 h-10 p-2 border-r border-gray-600 relative">
                                                            <div style="width: {{ round((($paiement->deuxiemeVersement/$paiement->prixVersement2) *100), 2)}}%;" class="bg-green-400 h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                                                                <p class="absolute font-bold">+{{ $paiement->deuxiemeVersement }}<br></p>
                                                                <p class="text-sm  absolute bottom-0">{{ round((($paiement->deuxiemeVersement/$paiement->prixVersement2) *100), 2)}}%</p>
                                                            </div>
                                                        </div>

                                                        <div class="w-1/3 h-10 p-2 border-r border-gray-600 relative">
                                                            <div style="width: {{ round((($paiement->troisiemeVersement/$paiement->prixVersement3) *100), 2)}}%;" class="bg-green-400 h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                                                                <p class="absolute font-bold">+{{ $paiement->troisiemeVersement }}<br></p>
                                                                <p class="text-sm  absolute bottom-0">{{ round((($paiement->troisiemeVersement/$paiement->prixVersement3) *100), 2)}}%</p>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    @endforeach
                                                </div>



                                                




                                                <div class="mt-10">
                                                    <h1 class="text-xl font-bold">Cours suivies et resultat </h1>


                                                    <div class="overflow-x-auto">
                                                        <table class="min-w-full bg-white dark:bg-gray-700 overflow-hidden">
                                                            
                                                            <!-- Header -->
                                                            <thead class="bg-gray-100 text-gray-700 dark:bg-gray-900 dark:text-gray-200 uppercase text-sm">
                                                                
                                                                <tr>
                                                                    @foreach ($this->getCours($this->DossierEtudiant->matricule, 1, $anneAcademique, $session) as $cours)
                                                                        <th class="py-3 px-6 text-left">{{ $cours->nom}}</th>
                                                                    @endforeach

                                                                </tr>
                                                            </thead>

                                                            <tbody class="text-gray-600 text-sm">

                                                                @php
                                                                    $noteDetails = $this->getNoteDetail($session, $anneAcademique, $this->DossierEtudiant->matricule);
                                                                    $coursList   = $this->getCours($this->DossierEtudiant->matricule, 1, $anneAcademique, $session);
                                                                @endphp

                                                                <tr class="border-b border-gray-400 hover:bg-gray-50 transition">

                                                                    @foreach ($coursList as $cours)

                                                                        @php
                                                                            $note = $noteDetails->where('codeCours', $cours->codeCours)->first();
                                                                        @endphp

                                                                        <td class="py-3 px-6 text-left">

                                                                            @if($note && ($note->noteIntra !== null || $note->examenFinal !== null))

                                                                                @php
                                                                                    $total = ($note->noteIntra ?? 0) + ($note->examenFinal ?? 0);
                                                                                @endphp

                                                                                <p class="{{ $total < 65 ? 'text-red-500' : 'text-green-500' }}">
                                                                                    {{ $total }}
                                                                                </p>

                                                                            @endif

                                                                            @if($note && ($note->noteIntra !== null && $note->examenFinal !== null))

                                                                                @php
                                                                                    $total = ($note->noteIntra ?? 0) + ($note->examenFinal ?? 0);
                                                                                @endphp

                                                                                <p class="font-normal {{ $total < 65 ? 'text-red-500' : 'text-green-500' }}">
                                                                                    Reprise: {{ $total < 65 ? ($note->noteRattrapage ?? 'Oui') : 'Non' }}
                                                                                </p>

                                                                            @endif

                                                                        </td>

                                                                    @endforeach

                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                                
                                            </div>

                                    </div>
                                </div>

                                @endforeach
                                

                            </div>


                            






                            <div class="mt-10">
                                <h1 class="text-xl font-bold">Historique des transactions </h1>


                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white dark:bg-gray-500 overflow-hidden">
                                        
                                        <!-- Header -->
                                        <thead class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-200 uppercase text-sm">
                                            <tr>
                                                <th class="py-3 px-6 text-left">Numero transaction</th>
                                                <th class="py-3 px-6 text-left">Date transaction</th>
                                                <th class="py-3 px-6 text-left">Montant</th>
                                                <th class="py-3 px-6 text-left">Motif</th>
                                                <th class="py-3 px-6 text-left">Mode de paiement</th>
                                            </tr>
                                        </thead>

                                        <!-- Body -->
                                        <tbody class="text-gray-600 dark:text-gray-200 text-sm">
                                            @foreach ($this->getTransactionByAnnee($anneAcademique) as $transaction)
                                                
                                                <tr class="border-b border-gray-400 hover:bg-gray-50 dark:hover:bg-gray-400 dark:hover:text-gray-800 transition">
                                                    <td class="py-2 px-6 font-medium">{{ $transaction->numeroTransaction }}</td>
                                                    <td class="py-2 px-6">{{ $transaction->dateTransaction }}</td>
                                                    <td class="py-2 px-6">{{ $transaction->montant }}</td>
                                                    <td class="py-2 px-6">{{ $transaction->motif }}</td>
                                                    <td class="py-2 px-6">{{ $transaction->modePaiement }}</td>
                                                </tr>

                                             @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>



                            <div class="mt-10 ">
                                <h1 class="text-xl font-bold">Bultins</h1>
                                
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
                                    {{-- @php
                                        dd($this->getbultins($anneAcademique));
                                    @endphp --}}
                                    @foreach ($this->getbultins($anneAcademique) as  $bultins )
                                        <div class="bg-white dark:bg-gray-500 rounded-lg shadow-sm border border-gray-600 p-2 hover:shadow-xl transition duration-300 flex flex-row items-center justify-between">
                                            <div>
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                </svg> --}}
                                                <div class="text-sm">
                                                    <p>Niveau: {{ $bultins->niveau }} </p>
                                                    <p>Session: {{ $bultins->session }} </p>
                                                </div>
                                            </div>

                                            <div wire:click="voirLePdf('{{ $bultins->matricule }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path d="M11.47 1.72a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72V7.5h-1.5V4.06L9.53 5.78a.75.75 0 01-1.06-1.06l3-3zM11.25 7.5V15a.75.75 0 001.5 0V7.5h3.75a3 3 0 013 3v9a3 3 0 01-3 3h-9a3 3 0 01-3-3v-9a3 3 0 013-3h3.75z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>




                            <div class="mt-10 ">
                                <h1 class="text-xl font-bold">Documents</h1>
                                
                                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">

                                    @foreach ($this->documents($anneAcademique) as  $document )
                                        <div class="bg-white dark:bg-gray-500 rounded-lg shadow-sm border border-gray-600 p-2 hover:shadow-xl transition duration-300 flex flex-row items-center justify-between">
                                            <div>
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                                </svg> --}}
                                                <div class="text-sm">
                                                    <p>NOM: {{ $document->nom }} </p>
                                                </div>
                                            </div>

                                            <div  wire:click="voirLeDocPdf('{{ $document->nom }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer hover:text-amber-400">
                                                <path d="M11.47 1.72a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72V7.5h-1.5V4.06L9.53 5.78a.75.75 0 01-1.06-1.06l3-3zM11.25 7.5V15a.75.75 0 001.5 0V7.5h3.75a3 3 0 013 3v9a3 3 0 01-3 3h-9a3 3 0 01-3-3v-9a3 3 0 013-3h3.75z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>    
            @endforeach
            <!-- Année 1 -->
            
        </div>

            </div>
        </div>
    </section>


    @endif


    <script>
        window.addEventListener('oppen-df', event => {
            window.open(event.detail.url, '_blank');
        });
    </script>
</section>
