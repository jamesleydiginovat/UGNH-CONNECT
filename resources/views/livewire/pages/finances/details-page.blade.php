<section class="relative bg-white dark:bg-gray-900 m-3 min-h-full">
    <div class=" right-0 top-0 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 mx-3'])
            
            >
                {{-- <svg x-show="pdf"  @click="pdf = !pdf" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-ugnh-blueFonce hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg> --}}
                <div  ></div>


                <svg @click="tableSlideNote = !tableSlideNote" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg> 
        </div>
    </div>


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


    <section class="dark:text-gray-50 m-3">

        <div>

            <div class="flex flex-col ">
            <div>
             @foreach ($this->InformationEtudiant as $etudiant)
                 {{-- etudiant --}}
                 <h1>Matricule: <span>{{ $etudiant->matricule}}</span></h1>
                <h1>Nom complet: <span>{{ $etudiant->nom." ".$etudiant->prenom}}</span></h1>
                <h1>Faculte: <span>{{$etudiant->faculte->first()?->nom ?? ''}}</span></h1>
                <h1>Niveau: <span>{{$niveauPourDetails}}</span></h1>
             @endforeach
             </div>


             <button 
                @click="form = !form"
                @class([
                    'flex flex-row p-2 rounded gap-2 transition-all duration-300',
                    'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
                    // DARK MODE
                    'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
                ])
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Enregistrer un paiement
            </button>
                
            </div>


            <div class="mt-10">
                <h1 class="text-xl font-bold mb-3">Historique des transactions </h1>


                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-500 overflow-hidden">
                        
                        <!-- Header -->
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-sm">
                            <tr>
                                <th class="py-3 px-3 text-left">Numero transaction</th>
                                <th class="py-3 px-3 text-left">Date transaction</th>
                                <th class="py-3 px-3 text-left">Montant</th>
                                <th class="py-3 px-3 text-left">Motif</th>
                                <th class="py-3 px-3 text-left">Mode de paiement</th>
                            </tr>
                        </thead>

                        <!-- Body -->
                        <tbody class="text-gray-600 dark:text-gray-200 text-sm">
                            @foreach ($this->TransactionByAnnee as $transaction)
                                
                                <tr class="border-b border-gray-400 hover:bg-gray-50 dark:hover:bg-gray-400 dark:hover:text-gray-800 transition">
                                    <td class="py-2 px-3 font-medium text-yellow-500">{{ $transaction->numeroTransaction }}</td>
                                    <td class="py-2 px-3">{{ $transaction->dateTransaction }}</td>
                                    <td class="py-2 px-3">{{ $transaction->montant }}</td>
                                    <td class="py-2 px-3">{{ $transaction->motif }}</td>
                                    <td class="py-2 px-3">{{ $transaction->modePaiement }}</td>
                                </tr>

                                @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </section>

</section>

