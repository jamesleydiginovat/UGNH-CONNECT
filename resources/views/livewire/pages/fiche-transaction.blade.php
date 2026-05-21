<section class="relative m-3 p-6 bg-gray-100 dark:bg-gray-900 rounded-2xl">
    <div class=" absolute right-1 top-1 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 '])
            @click="ficheTransaction = !ficheTransaction"
            >
                <div></div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
        </div>
    </div>
    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            Fiches de transaction
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Liste des fichiers PDF disponibles
        </p>
    </div>

    <!-- GRID -->
    <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
        @foreach ($this->FicheTransaction as $fichetransaction)
            <!-- CARD 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition p-4 border border-gray-200 dark:border-gray-700">

                <p class="text-center text-normal text-gray-900 dark:text-gray-50">
                    {{ $fichetransaction->codeTransaction }}
                </p>

                <p class="text-center text-sm text-gray-500 mt-1">
                    {{ $fichetransaction->created_at->diffForHumans() }}
                </p>

                <a wire:click="voirLePdf('{{ $fichetransaction->codeTransaction }}')" target="_blank"
                class="mt-4 block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-xl text-sm font-semibold transition">
                Afficher
                </a>

            </div>
        @endforeach
        

    </div>


    @if ($this->FicheTransaction->isNotEmpty())
        <div class="mt-4 bottom-0 w-full left-0">
            {{ $this->FicheTransaction->links('pagination::tailwind') }}
        </div>
    @endif


    <script>
        window.addEventListener('oppen-df', event => {
            window.open(event.detail.url, '_blank');
        });
    </script>
   

</section>