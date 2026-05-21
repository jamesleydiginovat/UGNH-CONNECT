
<section class="flex flex-col gap-4">
    @if ($this->getBultin('2') != null)
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 
            rounded-xl p-6 shadow-sm hover:shadow-md transition">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    📊 Publication des notes
                </h2>

                <span class="text-xs px-3 py-1 rounded-full 
                            bg-green-100 text-green-600 
                            dark:bg-green-900/40 dark:text-green-400">
                    Session 2
                </span>
            </div>

            <!-- CONTENU -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                    Bulletin de notes disponible
                </h3>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Les résultats académiques de la session 2 sont maintenant disponibles. 
                    Vous pouvez consulter votre bulletin en ligne ou le télécharger pour une utilisation ultérieure.
                </p>
            </div>

            <!-- INFO SUP -->
            <div class="mb-5 p-3 rounded-lg 
                        bg-gray-50 dark:bg-gray-800 
                        border border-gray-200 dark:border-gray-700">

                <p class="text-xs text-gray-500 dark:text-gray-400">
                    ⚠️ Assurez-vous de vérifier toutes vos notes. 
                    En cas d’erreur, contactez l’administration académique.
                </p>

            </div>

            <!-- ACTIONS -->
            <div class="flex flex-wrap gap-3">

                <!-- TELECHARGER -->
                <button wire:click="downloadBultin('{{ $this->getBultin('2') }}')" 
                class="flex items-center gap-2 px-4 py-2 rounded-lg 
                        bg-blue-600 hover:bg-blue-700 
                        text-white text-sm transition">

                    📥 Télécharger le bulletin
                </button>

                <!-- VOIR -->
                <button 
                    onclick="document.getElementById('iframeBulletin2').classList.toggle('hidden')"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg 
                        bg-gray-100 hover:bg-gray-200 
                        dark:bg-gray-800 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300 text-sm transition">

                    👁 Voir le bulletin
                </button>

            </div>

            <!-- IFRAME (MASQUÉ PAR DEFAUT) -->
            <div id="iframeBulletin2" class="hidden mt-5">

                <iframe src="#" 
                        class="w-full h-[500px] rounded-lg border border-gray-200 dark:border-gray-700">
                </iframe>

            </div>

        </div>
    @endif
    




@if ($this->getBultin('1') !=null)
<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 
            rounded-xl p-6 shadow-sm hover:shadow-md transition">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            📊 Publication des notes
        </h2>

        <span class="text-xs px-3 py-1 rounded-full 
                     bg-green-100 text-green-600 
                     dark:bg-green-900/40 dark:text-green-400">
            Session 1
        </span>
    </div>

    <!-- CONTENU -->
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
            Bulletin de notes disponible
        </h3>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            Les résultats académiques de la session 1 sont maintenant disponibles. 
            Vous pouvez consulter votre bulletin en ligne ou le télécharger pour une utilisation ultérieure.
        </p>
    </div>

    <!-- INFO SUP -->
    <div class="mb-5 p-3 rounded-lg 
                bg-gray-50 dark:bg-gray-800 
                border border-gray-200 dark:border-gray-700">

        <p class="text-xs text-gray-500 dark:text-gray-400">
            ⚠️ Assurez-vous de vérifier toutes vos notes. 
            En cas d’erreur, contactez l’administration académique.
        </p>

    </div>

    <!-- ACTIONS -->
    <div class="flex flex-wrap gap-3">

        <!-- TELECHARGER -->
        <button wire:click="downloadBultin('{{ $this->getBultin('1') }}')" 
           class="flex items-center gap-2 px-4 py-2 rounded-lg 
                  bg-blue-600 hover:bg-blue-700 
                  text-white text-sm transition">

            📥 Télécharger le bulletin
        </button>

        <!-- VOIR -->
        <button 
            onclick="document.getElementById('iframeBulletin').classList.toggle('hidden')"
            class="flex items-center gap-2 px-4 py-2 rounded-lg 
                   bg-gray-100 hover:bg-gray-200 
                   dark:bg-gray-800 dark:hover:bg-gray-700
                   text-gray-700 dark:text-gray-300 text-sm transition">

            👁 Voir le bulletin
        </button>

    </div>

    <!-- IFRAME (MASQUÉ PAR DEFAUT) -->
    <div id="iframeBulletin" class="hidden mt-5">

        <iframe src="#" 
                class="w-full h-[500px] rounded-lg border border-gray-200 dark:border-gray-700">
        </iframe>

    </div>

</div>
@endif

</section>