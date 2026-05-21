<section class="relative m-3 p-6 bg-gray-100 dark:bg-gray-900 rounded-2xl">
    <div class=" absolute right-1 top-1 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 '])
            @click="tarifFaculte = !tarifFaculte"
            >
                <div></div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
        </div>
    </div>


    <section class="p-6 bg-gray-100 dark:bg-gray-900 rounded-2xl">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Frais Académiques par Faculté
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Consultez les différents versements des facultés
            </p>
        </div>

        <!-- LISTE -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($this->TarifFaculte as $tarif)
                <!-- CARD -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition">

                    <!-- TOP -->
                    <div class="bg-ugnh-blueFonce text-white p-5">
                        <h2 class="text-xl font-bold">
                            {{ $this->nomFac($tarif->codeFac) }}
                        </h2>

                        <p class="text-sm text-gray-200 mt-1">
                            Niveau {{ $tarif->niveau }} - Session {{ $tarif->session }}
                        </p>
                    </div>

                    <!-- BODY -->
                    <div class="p-5 space-y-4">

                        <!-- VERSEMENT -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-xl">
                            <div>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    Versement 1
                                </p>

                                <p class="text-xs text-gray-500">
                                    Première tranche
                                </p>
                            </div>

                            <span class="font-bold text-lg text-green-600">
                                {{ $tarif->premierVersement }} HTG
                            </span>
                        </div>

                        <!-- VERSEMENT -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-xl">
                            <div>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    Versement 2
                                </p>

                                <p class="text-xs text-gray-500">
                                    Deuxième tranche
                                </p>
                            </div>

                            <span class="font-bold text-lg text-yellow-500">
                                {{ $tarif->deuxiemeVersement }} HTG
                            </span>
                        </div>

                        <!-- VERSEMENT -->
                        <div class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-xl">
                            <div>
                                <p class="font-semibold text-gray-700 dark:text-gray-200">
                                    Versement 3
                                </p>

                                <p class="text-xs text-gray-500">
                                    Dernière tranche
                                </p>
                            </div>

                            <span class="font-bold text-lg text-red-500">
                                {{ $tarif->troisiemeVersement }} HTG
                            </span>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="border-t border-gray-200 dark:border-gray-700 p-4 flex justify-between items-center">

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Total
                        </p>

                        <span class="text-xl font-bold text-ugnh-blueFonce dark:text-white">
                            {{ $tarif->prixTotal }}
                        </span>

                    </div>

                </div>

            @endforeach
            

        </div>

    </section>


</section>