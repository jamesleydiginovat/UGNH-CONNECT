<div @class([
            'flex flex-col justify-between gap-3 w-full',
            'sm:flex-row  '
        ])>
            <div class=" sm:w-1/2 w-full flex flex-row gap-3">
            
                <div @class([
                    'p-3 rounded w-full flex flex-row items-center justify-between bg-green-200',
                    'dark:border-gray-600 dark:bg-gray-700'
                ])>
                    <div @class(['flex flex-col gap-1'])>
                        <p class="text-sm text-gray-600 dark:text-gray-200">Cette section permet d’enregistrer et de suivre les paiements des étudiants, de consulter les montants versés et les soldes restants.</p>
                        <div>
                            <button @click="historiqueTransaction = !historiqueTransaction" class="hover:shadow-sm hover:bg-green-700 hover:text-gray-50 transition-all ease-in-out duration-300 bg-green-500 p-2 rounded-lg text-wrap text-ugnh-blueFonce text-sm mb-2">Voir l'Historique des transaction</button>
                            <button @click="tarifFaculte = !tarifFaculte" class="hover:shadow-sm hover:bg-green-700 hover:text-gray-50 transition-all ease-in-out duration-300 border border-green-500 p-2 rounded-lg text-ugnh-blueFonce dark:text-gray-200 text-sm">Tarifs des facultés</button>
                        </div>
                    </div>
            
                </div>
            </div>

                <div @class([
                    'p-3 rounded sm:w-1/2 w-full flex flex-row items-center justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700'
                ])>
                    <div @class(['flex flex-col gap-1'])>
                        <h1 @class([
                            'text-ugnh-blueFonce flex flex-row gap-2 text-nowrap',
                            'dark:text-gray-300'
                        
                        ])> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 bg-green-300 rounded-full p-0.5 text-ugnh-blueFonce ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            Paiements reçus
                        </h1>
                        <p @class([
                            'font-bold text-green-600 text-xl',
                            'dark:text-gray-300'
                            ])>
                            {{ number_format($this->SommePaiementRecus, 2) }} HTG</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Somme totale des paiements effectués par les étudiants.</p>
                    </div>
            
            </div>

</div>