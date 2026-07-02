<section class="relative m-3 p-6 bg-gray-100 dark:bg-gray-900 rounded-2xl">

    <div class="absolute right-1 top-1">
        <div
            class="text-end flex flex-row justify-between cursor-pointer p-1 text-red-500"
            @click="tarifFaculte = !tarifFaculte">

            <div></div>

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" />

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

        @if(session()->has('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 2000)"
                x-show="show"
                x-transition
                class="mb-4 p-4 rounded-lg bg-green-100 text-green-700"
            >
                {{ session('success') }}
            </div>
        @endif

        <!-- LISTE -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach ($this->TarifFaculte as $tarif)

                <!-- CARD -->
                <div
                    wire:click="editTarif({{ $tarif->id }})"
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 cursor-pointer">

                    <!-- TOP -->
                    <div class="bg-ugnh-blueFonce text-white p-5">

                        <h2 class="text-xl font-bold">
                            {{ $this->nomFac($tarif->codeFac) }}
                        </h2>

                        <p class="text-sm text-gray-200 mt-1">
                            Niveau {{ $tarif->niveau }}
                            -
                            Session {{ $tarif->session }}
                        </p>

                    </div>

                    <!-- BODY -->
                    <div class="p-5 space-y-4">

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
                                {{ number_format($tarif->premierVersement,2) }} HTG
                            </span>

                        </div>

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
                                {{ number_format($tarif->deuxiemeVersement,2) }} HTG
                            </span>

                        </div>

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
                                {{ number_format($tarif->troisiemeVersement,2) }} HTG
                            </span>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="border-t border-gray-200 dark:border-gray-700 p-4 flex justify-between items-center">

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Total
                        </p>

                        <span class="text-xl font-bold text-ugnh-blueFonce dark:text-white">
                            {{ number_format($tarif->prixTotal,2) }} HTG
                        </span>

                    </div>

                </div>

            @endforeach

        </div>

    </section>

    <!-- MODAL -->
    @if($showModal)

        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-3xl mx-4">

                <!-- Header -->
                <div class="flex justify-between items-center p-5 border-b dark:border-gray-700">

                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        Modifier les frais académiques
                    </h2>

                    <button
                        type="button"
                        wire:click="closeModal"
                        class="text-red-500 hover:text-red-700">

                        ✕

                    </button>

                </div>

                <!-- Formulaire -->
                <form wire:submit.prevent="updateTarif">

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 dark:text-gray-50">

                        <div>
                            <label class="block mb-2 font-medium">
                                Faculté
                            </label>

                            <input
                                type="text"
                                readonly
                                value="{{ $this->nomFac($codeFac) }}"
                                class="w-full p-3 border rounded-xl bg-gray-100 dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Niveau
                            </label>

                            <input
                                type="text"
                                wire:model="niveau"
                                readonly
                                class="w-full p-3 border rounded-xl bg-gray-100 dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Session
                            </label>

                            <input
                                type="text"
                                wire:model="session"
                                readonly
                                class="w-full p-3 border rounded-xl bg-gray-100 dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Premier Versement
                            </label>

                            <input
                                type="number"
                                wire:model="premierVersement"
                                class="w-full p-3 border rounded-xl">

                            @error('premierVersement')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Deuxième Versement
                            </label>

                            <input
                                type="number"
                                wire:model="deuxiemeVersement"
                                class="w-full p-3 border rounded-xl">

                            @error('deuxiemeVersement')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Troisième Versement
                            </label>

                            <input
                                type="number"
                                wire:model="troisiemeVersement"
                                class="w-full p-3 border rounded-xl">

                            @error('troisiemeVersement')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">
                                Prix Total
                            </label>

                            <input
                                type="number"
                                wire:model="prixTotal"
                                class="w-full p-3 border rounded-xl">

                            @error('prixTotal')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-end gap-3 p-5 border-t dark:border-gray-700">

                        <button
                            type="button"
                            wire:click="closeModal"
                            class="px-5 py-2 rounded-xl bg-gray-500 text-white">
                            Annuler
                        </button>

                        <button
                            type="submit"
                            class="px-5 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700">
                            Enregistrer les modifications
                        </button>

                    </div>

                </form>

            </div>

        </div>

    @endif

</section>