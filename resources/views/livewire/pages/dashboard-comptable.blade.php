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
                'w-full bg-white shadow-xs rounded h-full overflow-hidden',
                'dark:border-gray-900 dark:border dark:bg-gray-900'
            ])>
                <livewire:pages.transaction-by-mounth />
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
    'p-4 rounded-xl bg-white shadow-sm w-full bg-ugnh-blueClair',
    'dark:border dark:border-gray-700 dark:bg-gray-900'
])>

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold dark:text-gray-100">
                    Dernières transactions
                </h2>

                <span class="text-xs text-gray-500 dark:text-gray-400">
                    Mise à jour récente
                </span>
            </div>

            <!-- TABLE -->
            <div class="overflow-hidden rounded-lg border dark:border-gray-700">

                <table class="min-w-full text-sm">

                    <!-- HEAD -->
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">Date</th>
                            <th class="px-4 py-3 text-left font-medium">Montant</th>
                            <th class="px-4 py-3 text-left font-medium">Statut</th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">

                        @forelse($this->lastTransactions as $transaction)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                                <!-- DATE -->
                                <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                                    <div class="text-sm font-medium">
                                        {{ $transaction->created_at->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $transaction->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                <!-- MONTANT -->
                                <td class="px-4 py-3 font-semibold text-gray-800 dark:text-gray-100">
                                    {{ number_format($transaction->montant, 0, ',', ' ') }} G
                                </td>

                                <!-- STATUT -->
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full
                                        {{ $transaction->statut == 'Valide'
                                            ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                            : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' }}">
                                        
                                        {{ ucfirst($transaction->statut) }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-8 text-gray-500 dark:text-gray-400">
                                    Aucune transaction disponible
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

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
                    $hasPermission = Auth::check() && Auth::user()->hasPermission('Gestion des finances');
                @endphp

                <a href="{{ $hasPermission ? Route('gestion-des-finances') : '#' }}">
                <div @class(['border-b border-[#ccc] hover:bg-ugnh-blueClair', 'dark:border-gray-600 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>
                    <h1 @class(['text-start font-normal text-sm py-5 px-3 text-gray-600', 'dark:text-gray-300 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>Etat financiere</h1>
                </div>

                @php
                    $hasPermission = Auth::check();
                @endphp

                <a  href="{{ $hasPermission ? Route('mon-profile') : '#' }}">
                <div @class(['border-b border-[#ccc] hover:bg-ugnh-blueClair', 'dark:border-gray-600 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>
                    <h1 @class(['text-start font-normal text-sm py-5 px-3 text-gray-600', 'dark:text-gray-300 dark:hover:bg-gray-800 transition-all easy-in-out duration-500'])>Profile</h1>
                </div>
                </a>

            </div>

            </div>

        </section>

    </section>

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