<div class="mx-3 mt-6 rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-lg">

    <!-- HEADER -->
    <div class="p-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-ugnh-blueClair to-blue-100 dark:from-gray-800 dark:to-gray-700">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <!-- TITRE -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Historique des activités
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                    Consultez toutes les actions effectuées dans le système
                </p>
            </div>

            <!-- RECHERCHE -->
            <div class="relative w-full lg:w-96">

                <input 
                    wire:model.live="search"
                    type="text"
                    placeholder="Rechercher une action, un utilisateur..."
                    class="w-full rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 py-3 pl-12 pr-4 outline-none focus:ring-2 focus:ring-ugnh-blueFonce text-gray-700 dark:text-gray-200 shadow-sm"
                >

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 absolute left-4 top-3.5 text-gray-400">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>

            </div>

        </div>

        <!-- FILTRES -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mt-5">

            <!-- TYPE ACTION -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-2 shadow-sm border border-gray-200 dark:border-gray-700">
                <select 
                    wire:model.live="typeAction"
                    class="w-full bg-transparent outline-none text-gray-700 dark:text-gray-200"
                >
                    <option class="dark:bg-gray-700 dark:text-gray-50" value="">Type d'action</option>
                    <option class="dark:bg-gray-700 dark:text-gray-50"  value="Ajout">Ajout</option>
                    <option class="dark:bg-gray-700 dark:text-gray-50"  value="Modification">Modification</option>
                    <option class="dark:bg-gray-700 dark:text-gray-50"  value="Suppression">Suppression</option>
                    <option class="dark:bg-gray-700 dark:text-gray-50"  value="Connexion">Connexion</option>
                    <option class="dark:bg-gray-700 dark:text-gray-50"  value="Paiement">Paiement</option>
                    <option class="dark:bg-gray-700 dark:text-gray-50"  value="Génération PDF">Génération PDF</option>
                </select>
            </div>

            <!-- DATE -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-2 shadow-sm border border-gray-200 dark:border-gray-700">
                <input 
                    wire:model.live="dateHistorique"
                    type="date"
                    class="w-full bg-transparent outline-none text-gray-700 dark:text-gray-200"
                >
            </div>

            <!-- UTILISATEUR -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-2 shadow-sm border border-gray-200 dark:border-gray-700">
                <input 
                    wire:model.live="codeUtilisateur"
                    type="text"
                    placeholder="Code utilisateur"
                    class="w-full bg-transparent outline-none text-gray-700 dark:text-gray-200"
                >
            </div>

            <!-- RESET -->
            <button
                wire:click="resetFiltre"
                class="bg-red-600 hover:bg-red-700 text-white rounded-xl px-4 py-2 transition-all duration-300 shadow-md hover:shadow-lg"
            >
                Réinitialiser les filtres
            </button>

        </div>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                <tr class="text-left text-sm text-gray-600 dark:text-gray-300">

                    <th class="px-5 py-4 font-semibold">
                        Utilisateur
                    </th>

                    <th class="px-5 py-4 font-semibold">
                        Action
                    </th>

                    <th class="px-5 py-4 font-semibold">
                        Code
                    </th>

                    <th class="px-5 py-4 font-semibold">
                        Date
                    </th>

                    <th class="px-5 py-4 text-center font-semibold">
                        Options
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->Historique as $historique)

                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-ugnh-blueClair dark:hover:bg-gray-800/50 transition-all duration-200">

                        <!-- USER -->
                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-full bg-ugnh-blueFonce text-white flex items-center justify-center font-bold shadow">
                                    {{ strtoupper(substr($historique->code, 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-white">
                                        {{ $historique->code }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        Utilisateur système
                                    </p>
                                </div>

                            </div>

                        </td>

                        <!-- ACTION -->
                        <td class="px-5 py-4">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                
                                @if(str_contains(strtolower($historique->action), 'ajout'))
                                    bg-green-100 text-green-700
                                @elseif(str_contains(strtolower($historique->action), 'supp'))
                                    bg-red-100 text-red-700
                                @elseif(str_contains(strtolower($historique->action), 'modif'))
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-blue-100 text-blue-700
                                @endif
                            
                            ">
                                {{ $historique->action }}
                            </span>

                        </td>

                        <!-- RECORD -->
                        <td class="px-5 py-4">

                            <p class="font-medium text-gray-700 dark:text-gray-300">
                                {{ $historique->record_code }}
                            </p>

                        </td>

                        <!-- DATE -->
                        <td class="px-5 py-4">

                            <div class="flex flex-col">

                                <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $historique->created_at->format('d/m/Y') }}
                                </span>

                                <span class="text-xs text-gray-500">
                                    {{ $historique->created_at->format('H:i:s') }}
                                </span>

                            </div>

                        </td>

                        <!-- MENU -->
                        <td class="px-5 py-4 text-center">

                            <div x-data="{ open:false }" class="relative inline-block">

                                <!-- BUTTON -->
                                <button 
                                    @click="open = !open"
                                    class="p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6 text-gray-600 dark:text-gray-300">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                    </svg>
                                </button>

                                <!-- DROPDOWN -->
                                <div 
                                    x-show="open"
                                    @click.outside="open = false"
                                    x-transition
                                    class="absolute right-0 mt-2 w-52 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden z-50"
                                >

                                    {{-- <button 
                                        class="w-full text-left px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm"
                                    >
                                        Voir les détails
                                    </button> --}}

                                    <button 
                                        class="w-full text-left px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-50 text-sm"
                                    >
                                        Copier le code
                                    </button>

                                    <button 
                                        class="w-full text-left px-4 py-3 hover:bg-red-100 dark:hover:bg-red-900 text-red-600 text-sm"
                                    >
                                        Supprimer l’historique
                                    </button>

                                </div>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="py-20 text-center">

                            <div class="flex flex-col items-center gap-3">

                                <div class="w-20 h-20 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-10 h-10 text-gray-400">

                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v6h4.5" />
                                    </svg>

                                </div>

                                <div>

                                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                        Aucun historique trouvé
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Aucun résultat ne correspond aux filtres sélectionnés.
                                    </p>

                                </div>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    @if ($this->Historique->hasPages())

        <div class="p-5 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">

            {{ $this->Historique->links('pagination::tailwind') }}

        </div>

    @endif

</div>