<section class="dark:text-gray-50 p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">

    <!-- 🔷 TOP : Résumé -->
    <section class="flex flex-col md:flex-row gap-6 w-full mb-8">

        <!-- 📊 GAUCHE -->
        <div class="w-full md:w-1/2 grid gap-6">

            <!-- 💰 Total payé -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Total frais payés</p>
                <h1 class="text-2xl font-bold text-green-600 mt-2">
                    {{-- 25,000 HTG --}} {{ $this->fraisDejaPaye() }} HTG
                </h1>
            </div>

            <!-- ⚠️ Balance -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
                <p class="text-sm text-gray-500">Balance restante</p>
                <h1 class="text-2xl font-bold text-red-500 mt-2">
                    {{-- 5,000 HTG --}}
                    @php
                        $dejaPayer = $this->fraisDejaPaye();
                        $session1 = $this->fraisRester('1')->prixTotal ?? "";
                        $session2 = $this->fraisRester('2')->prixTotal ?? "";
                        $total= $session1 + $session2;

                        // dd($session1." ".$session2." ".$total);
                        $reste = $total - $dejaPayer;

                    @endphp
                    {{ $reste+6200  }} HTG
                </h1>
            </div>

        </div>

        <!-- 📘 DROITE : frais -->
        <div class="w-full md:w-1/2 bg-white dark:bg-gray-800 p-6 rounded-xl shadow flex flex-col justify-between">

            <div>
                <p class="text-sm text-gray-500">Frais de scolarité</p>
                <h1 class="text-2xl font-bold text-blue-600 mt-2">
                  {{ $total  }}  HTG
                </h1>
                 <p class="text-sm text-gray-400 font-bold">Session 1: <span class="text-gray-400 font-normal">1er Versement + 2eme Versement + 3eme Versement = Frais 1er Session</span></p>
                 <p class="text-sm text-gray-400 font-bold">Session 1: <span class="text-gray-400 font-normal">{{ $this->fraisRester('1')->premierVersement ?? "" }} + {{ $this->fraisRester('1')->deuxiemeVersement ?? "" }} + {{ $this->fraisRester('1')->troisiemeVersement ?? "" }} = {{ $session1 }}</span></p>
                 <p class="text-sm text-gray-400 font-bold">Session 2: <span class="text-gray-400 font-normal">1er Versement + 2eme Versement + 3eme Versement = Frais 2eme Session</span></p>
                 <p class="text-sm text-gray-400 font-bold">Session 2: <span class="text-gray-400 font-normal">{{ $this->fraisRester('2')->premierVersement ?? "" }} + {{ $this->fraisRester('2')->deuxiemeVersement ?? "" }} + {{ $this->fraisRester('2')->troisiemeVersement ?? "" }} = {{ $session2 }}</span></p>
            </div>

            <!-- Progression -->
            @php
                $effectif;
                if($this->fraisDejaPaye() >$total){
                    $effectif = $total;
                }
                else{
                    $effectif = $this->fraisDejaPaye();
                }
            @endphp
            <div class="mt-6">
                <div class="w-full bg-gray-200 dark:bg-gray-700 h-3 rounded-full">
                    <div class="bg-green-500 h-3 rounded-full" style="width: {{ ($effectif/$total)*100 }}%"></div>
                </div>
                <p class="text-sm mt-2 text-gray-500">
                    
                    {{ ($effectif/$total)*100 }}% payé
                </p>
            </div>

        </div>

    </section>

    <!-- 🔷 HISTORIQUE -->
    <section class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold text-gray-700 dark:text-white">
                📄 Historique des transactions
            </h1>

            <!-- 🔍 recherche (optionnel) -->
            <input type="text" placeholder="Rechercher..."
                class="px-3 py-2 border rounded-md dark:bg-gray-900 dark:border-gray-700 text-sm">
        </div>

        <!-- 📊 TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="text-gray-500 text-sm border-b dark:border-gray-700">

                        <th class="py-3">Date</th>
                        <th>Code Transaction</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Reçu</th>
                    </tr>
                </thead>

                <tbody class="text-sm">

                    <!-- 🔁 Exemple ligne -->
                    @foreach ($this->historiqueTransaction as $transaction )
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-3">{{ $transaction->dateTransaction }}</td>
                        <td class="text-amber-400">{{ $transaction->numeroTransaction }}</td>
                        <td class="text-green-600 font-semibold">{{ $transaction->montant }} HTG</td>
                        <td>{{ $transaction->modePaiement }}</td>
                        <td>
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">
                                Payé
                            </span>
                        </td>
                        <td>
                            <button class="text-blue-500 hover:underline text-sm">
                                Voir
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    

                    {{-- <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-3">01 Mai 2026</td>
                        <td class="text-green-600 font-semibold">10,000 HTG</td>
                        <td>Inscription</td>
                        <td>
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">
                                Payé
                            </span>
                        </td>
                        <td>
                            <button class="text-blue-500 hover:underline text-sm">
                                Voir
                            </button>
                        </td>
                    </tr> --}}

                </tbody>
                

            </table>

                @if ($this->historiqueTransaction->isNotEmpty())
                    <div class="mt-4 bottom-0 w-full left-0">
                        {{ $this->historiqueTransaction->links('pagination::tailwind') }}
                    </div>
                @endif
        </div>

    </section>

</section>