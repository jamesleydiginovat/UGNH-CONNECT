<section class="relative bg-gray-100 dark:bg-gray-900  m-3 h-full">
    <style>
    .page {
        width: 210mm;
        height: 297mm;
        padding: 10mm;
        font-family: 'Times New Roman', Times, serif;
        background-color: white;
    }
    .page-break {
        page-break-after: always;
    }

    .header {
        display: flex;
        flex-direction: row;
        align-items: center;
        border-bottom: 1px solid black;
        padding-bottom: 10px;
    }

    /* LOGO */
    .logo {
        width: 80px;
        height: 80px;
    }

    /* TITRE CENTRÉ */
    .title {
        width: 100%;
        text-align: center;
    }

    .title h1 {
        font-size: 20px;
        font-weight: bold;
    }

    .title h2 {
        font-size: 18px;
    }

    .title h3 {
        font-size: 14px;
    }

    </style>

    <div class=" right-0 top-0 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 '])
            @click="tableSlideNoteByStudent = !tableSlideNoteByStudent"
            >
                <div></div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
        </div>
    </div>
    <div>
    <div class="flex flex-row p-2 justify-between">
        <div></div>
         {{-- <button @click="form = !form" class="hover:shadow-sm hover:bg-ugnh-blueHover bg-ugnh-blueFonce hover:text-gray-50 transition-all ease-in-out duration-300 border border-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">Ajouter une nouvelle note</button> --}}
         <div class="flex flex-row gap-3">
            @if (!$this->isNoteComplet() && ($this->isDejaAdmisOrNot() ==null)) 
                 <button  wire:click="admissionEtudiant('yes')" class="hover:shadow-sm hover:bg-ugnh-blueHover bg-green-600 hover:text-gray-50 transition-all ease-in-out duration-300 border border-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">Admis</button>
                 <button  wire:click="admissionEtudiant('no')" class="hover:shadow-sm hover:bg-ugnh-blueHover bg-red-600 hover:text-gray-50 transition-all ease-in-out duration-300 border border-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">Echouee</button>
            @endif 

            @if ($this->isSession1CompleteAndSession2Empty())
                 <button wire:click="PublicationNotesSession1Etudiant('null')" class="hover:shadow-sm hover:bg-ugnh-blueHover bg-green-600 hover:text-gray-50 transition-all ease-in-out duration-300 border border-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">Pubiblier</button>
            @endif
            
        </div>

    </div>

    {{-- <div class="p-2 dark:text-gray-200"> --}}
        
        <section class="flex flex-col gap-2 w-full">

                <div class=" relative page  bg-white text-black mx-auto">
                    <section class="flex flex-row  items-center border-b border-black pb-2">
                        <div>
                            <img class="min-w-20 h-20 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                        </div>

                        <div class="w-full text-center">
                            <h1 class="text-3xl font-bold">UNGH</h1>
                            <h1 class="text-3xl font-bold">Universite du Grand Nord d'Haiti</h1>
                            <h2 class="text-lg">La science au service du developpement</h2>
                            <h3>142, rue 7A, HT1110 - Cap-Haitien, Haiti</h3>
                        </div>

                        <div>
                            <img class="min-w-20 h-20 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                        </div>

                    </section>



                    <section>
                        @foreach ($this->InfosEtudiant as $infos)

                            <div class="flex flex-col text-center text-xl font-bold">
                                <p>Faculté des {{ $infos->faculte->first()?->nom ?? '' }}</p>
                                <p>Bulletin pour l’année académique 2026-2027</p>
                            </div>

                            <div class="flex flex-row justify-between mb-5">
                                <div class="flex flex-row gap-3">
                                    <p>Matricule: <span>{{ $infos->matricule ?? " " }}</span></p>
                                    <p>Nom et prenom: <span>{{ $infos->nom ?? " " }} {{  $infos->prenom ?? " " }}</span></p>
                                </div>
                                
                                <div class="flex flex-row gap-3">
                                    <p>Niveau: <span>{{ $this->niveau }}</span></p>

                                </div>
                            </div>
                            
                        @endforeach
                        


                        <section>
                            <table class="w-full border border-gray-300 text-sm text-left">
                                
                                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                    
                                    <tr>
                                        <th class="px-1 py-1 border border-gray-300">Nom du cours</th>
                                        <th class="px-1 py-1 border border-gray-300">Note</th>
                                        <th class="px-1 py-1 border border-gray-300">Reprise</th>
                                        <th class="px-1 py-1 border border-gray-300">Crédits</th>
                                        <th class="px-1 py-1 border border-gray-300">Mention</th>
                                    </tr>
                                </thead>

                                <tbody class="text-gray-700">
                                    <!-- Exemple ligne -->
                                    @php
                                        $moyenne1 = 0;
                                        $moyenne2 = 0;

                                        $total1 =0;
                                        $total2 =0;
                                    @endphp
                                    @foreach ($this->noteByEtudiant as $session => $notes )
                                        
                                        <tr>
                                            <th class="px-1 py-1 bg-yellow-600 border border-yellow-600">Session {{ $session }}</th>
                                        </tr>

                                        @php
                                            $total = 0;
                                            $creditsTotal = 0;
                                            $nombreMatiere=0;
                                        @endphp


                                        @foreach ($notes as $note)

                                            @php
                                                if ($note->noteIntra != null || $note->examenFinal) {
                                                $noteFinal = $note->noteIntra + $note->examenFinal;
                                                }
                                                else{
                                                    $noteFinal='-';
                                                }



                                                if ($note->noteIntra != null && $note->examenFinal) {
                                                $noteFinal = $note->noteIntra + $note->examenFinal;
                                                }
                                                else{
                                                    $noteFinal='-';
                                                }


                                            @endphp

                                            <tr class="hover:bg-gray-50">
                                                <td class="px-1 py-1 border border-gray-200">{{ $note->nom }}</td>
                                                <td class="px-1 py-1 border border-gray-200">{{ $noteFinal }}</td>
                                                <td class="px-1 py-1 border border-gray-200">
                                                    @if (($noteFinal < 65 && is_null($note->noteRattrapage) && !is_null($note->noteIntra) && !is_null($note->examenFinal)))
                                                        Oui
                                                    @elseif (is_null($note->noteIntra) || is_null($note->examenFinal))
                                                        -
                                                    @else
                                                        {{($note->noteRattrapage ?? 'Non') }}
                                                    @endif
                                                </td>
                                                <td class="px-1 py-1 border border-gray-200">{{ $note->credit ?? 0 }}</td>
                                                <td class="px-1 py-1 border border-gray-200">
                                                    @if ($noteFinal !='-')
                                                      {{ $this->getMention($noteFinal)  }}  
                                                    @else
                                                        {{ $noteFinal }}
                                                    @endif
                                                </td>
                                            </tr>

                                            @php
                                                $nombreMatiere +=1;
                                                $total += ($note->noteIntra + $note->examenFinal ?? 0);
                                                $creditsTotal += ($note->credit ?? 1);
                                            @endphp

                                        @endforeach

                                        <tr class="hover:bg-gray-50">
                                            <td class="px-1 py-1 border border-gray-200">Total: {{ $total}}</td>
                                        </tr>

                                        <tr class="hover:bg-gray-50">
                                            <td class="px-1 py-1 border border-gray-200">Moyenne: {{ $total/($nombreMatiere*10) }}</td>
                                        </tr>

                                        @php
                                            
                                            if ($session == '1') {
                                               $moyenne1 = $total/($nombreMatiere*10);
                                               $total1 =$total;
                                            }
                                            elseif ($session == '2') {
                                                $moyenne2 = $total/($nombreMatiere*10);
                                                $total2 = $total;
                                            }
                                        @endphp

                                    @endforeach
                                    
                                     
                                </tbody>

                            </table>



                            <table class="mt-5 w-full border border-gray-300 text-sm text-left">
                                
                                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                    <tr>
                                        <th class="px-1 py-1 border border-gray-300">Total: {{ ($total1 + $total2) ? ($total1 + $total2) : 0 }} </th>
                                    </tr>

                                    <tr>
                                        <th class="px-1 py-1 border border-gray-300">Moyenne de l'annee: {{ ($moyenne1 + $moyenne2) ? ($moyenne1 + $moyenne2) / 2 : 0 }}</th>
                                    </tr>
                                </thead>
                    
                            </table>
                            
                        </section>

                        
                    </section>


                    <section class="p-10 absolute w-full bottom-0 left-0">
                            <div class="flex flex-row justify-between items-center">
                                <div>
                                     <p>Fait à l’UGNH, le 27 avril 2026</p>
                                </div>
                               
                                <div class="text-center">
                                    <p>______________________</p>
                                    <p>Décanat de Sc. informatique</p>
                                </div>

                                <div class="text-center">
                                    <p>______________________</p>
                                    <p>Rectorat de l’UGNH</p>
                                </div>
                            </div>
                    </section>
                </div>
        </section>

    {{-- </div> --}}
     
    <livewire:pages.notes-evaluation.formulaire-notes-evaluation />

</section>

