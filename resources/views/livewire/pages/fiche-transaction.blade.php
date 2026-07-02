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

    <div class="mb-6">
        <div 
		:class="!inpuRecherche ? 'md:bg-ugnh-blueClair p-1 rounded md:shadow-sm md:w-7  lg:w-full lg:bg-transparent lg:p-0  lg:shadow-none w-full' : 'w-full'"
		@class([
			"flex flex-row items-center relative  ",
			''
		])>
            <input wire:model.live="search" :class="!inpuRecherche ? 'w-full p-1 pe-8  md:w-0 lg:w-full md:p-0 md:pe-0 lg:p-1 lg:pe-8' : 'w-full p-1 pe-8'" class=" bg-blue-50 dark:bg-gray-600 shadow-sm rounded  outline-0  dark:text-gray-300 dark:border-gray-600 " type="search" name="" id="" placeholder="Rechercher">
            <div @click="inpuRecherche= !inpuRecherche"  @class(['bg-ugnh-blueFonce p-1 right-0 rounded absolute md:me-1 me-2 lg:me-1 '])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4  text-gray-50">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- GRID -->
    <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6">

        @foreach ($this->FicheTransaction as $fichetransaction)

            <div class="group relative overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 
                bg-white dark:bg-gray-800 p-4 shadow-sm hover:shadow-2xl 
                hover:-translate-y-1 transition-all duration-300">

                <!-- Background effect -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 dark:bg-blue-900 
                    rounded-full blur-3xl opacity-30 group-hover:opacity-60 transition">
                </div>

                <!-- Icon -->
                <div class="relative z-10 flex items-center justify-center w-12 h-12 mx-auto 
                    rounded-xl bg-ugnh-blueFonce text-white shadow-md">

                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.8" 
                        stroke="currentColor" 
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5A3.375 3.375 0 0010.125 2.25H6.75A2.25 2.25 0 004.5 4.5v15A2.25 2.25 0 006.75 21.75h10.5A2.25 2.25 0 0019.5 19.5v-5.25z" />
                    </svg>

                </div>

                <!-- Content -->
                <div class="relative z-10 mt-4 text-center">

                    <p class="text-[11px] uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Transaction
                    </p>

                    <h3 class="mt-1 font-bold text-sm text-gray-800 dark:text-white break-all">
                        {{ $fichetransaction->codeTransaction }}
                    </h3>

                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        {{ $fichetransaction->created_at->diffForHumans() }}
                    </p>

                </div>

                <!-- Button -->
                <button
                    wire:click="voirLePdf('{{ $fichetransaction->codeTransaction }}')"
                    class="relative z-10 mt-4 w-full rounded-xl bg-ugnh-blueFonce 
                    hover:bg-blue-900 text-white py-2 text-sm font-semibold 
                    transition duration-300 shadow-md hover:shadow-lg"
                >
                    Afficher PDF
                </button>

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