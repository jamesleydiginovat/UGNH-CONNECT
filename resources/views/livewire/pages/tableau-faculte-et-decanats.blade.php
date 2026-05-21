<div class="p-4 m-3 bg-gray-50 dark:bg-gray-900 min-h-screen">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($this->Facultes as $faculte )
        <!-- CARD STATIC EXAMPLE -->
        <div 
            x-data="{
                edit: false,
                code: '{{ $faculte->codeFac }}',
                nom: '{{ $faculte->nom }}',
                nombreNiveau: {{ $faculte->nombreNiveau }}
            }"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border  dark:border-gray-700 p-5 transition">
            
            <!-- VIEW MODE -->
            <div x-show="!edit">

                <div class="flex justify-between items-start mb-4">

                    <div>
                        <h2 class="text-lg font-bold text-gray-800 dark:text-white" x-text="nom"></h2>
                        <p class="text-sm text-gray-500">Code : <span x-text="code"></span></p>
                    </div>

                    <span class="px-3 py-1 text-xs rounded-full bg-ugnh-blueFonce text-white">
                        Faculté
                    </span>

                </div>

                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">

                    <div class="flex justify-between">
                        <span>Code</span>
                        <span class="font-semibold" x-text="code"></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Nom</span>
                        <span class="font-semibold" x-text="nom"></span>
                    </div>

                    <div class="flex justify-between">
                        <span>Niveaux</span>
                        <span class="font-semibold text-gray-50" x-text="nombreNiveau"></span>
                    </div>

                </div>

                <div class="mt-5 flex gap-2">

                    <button 
                        wire:click="edit('{{ $faculte->id }}')"
                        @click="edit = true"
                        class="flex-1 bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white py-2 rounded-xl text-sm">
                        Modifier
                    </button>

                    {{-- <button class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl text-sm">
                        Supprimer
                    </button> --}}

                </div>

            </div>

            <!-- EDIT MODE -->
            <div x-show="edit" x-cloak>

                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
                    Modifier Faculté
                </h2>

                <div class="space-y-3">

                    <input
                        wire:model="codeFac" 
                        x-model="code"
                        class="w-full p-2 rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        placeholder="Code"
                    >

                    <input 
                        wire:model="nom" 
                        x-model="nom"
                        class="w-full p-2 rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        placeholder="Nom"
                    >

                    <input 
                        wire:model="nombreNiveau" 
                        type="number"
                        x-model="nombreNiveau"
                        class="w-full p-2 rounded-lg border dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        placeholder="Nombre de niveaux"
                    >

                </div>

                <div class="mt-5 flex gap-2">

                    <button 
                        wire:click="updateFaculte"
                        @click="edit = false"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-xl text-sm">
                        Sauvegarder
                    </button>

                    <button 
                        @click="edit = false"
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 rounded-xl text-sm">
                        Annuler
                    </button>

                </div>

            </div>

        </div>
        @endforeach
    </div>

</div>