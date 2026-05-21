<section class=" relative w-full min-h-screen p-6 bg-gray-100 dark:bg-gray-900">
    <div class="absolute right-0 top-0 p-1 rounded-sm hover:bg-red-300">
        <svg  @click="page = 'home'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>

    <div class="w-full bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        @if (session()->has('success'))
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                x-transition
                class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg"
            >
                {{ session('success') }}
            </div>
        @endif
        <!-- 🧠 Titre -->
        <h2 class="text-xl font-bold text-gray-700 dark:text-white mb-6">
            Création de devoir
        </h2>

        <form wire:submit="save" class="space-y-6">

            <!-- 🔷 Ligne 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- CODE -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Code du devoir</label>

                    <input @readonly(true) wire:model.live="code" type="text"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('code') border-red-600 @enderror">

                    @error('code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TITRE -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Titre</label>

                    <input wire:model.live="titre" type="text"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('titre') border-red-600 @enderror">

                    @error('titre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Faculte -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Faculte</label>

                    <select wire:model.live="codeFac"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('faculte') border-red-600 @enderror">

                        <option value="">Choisir une faculte</option>
                         @foreach ($this->FaculteProf as $fac=>$cours)
                            <option value="{{ $fac }}">{{ $this->nomFac($fac) }}</option> 
                        @endforeach
                    </select>

                    @error('faculte')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Faculte -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Niveau</label>

                    <select wire:model.live="niveau"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('niveau') border-red-600 @enderror">

                        <option value="">Choisir un niveau</option>
                        @if($this->NiveauFaculteProf->isNotEmpty())
                            @foreach ($this->NiveauFaculteProf as $niveau=>$cours)
                                <option value="{{ $niveau }}">{{ $niveau}}</option> 
                            @endforeach
                        
                        @endif
                        
                    </select>

                    @error('niveau')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Faculte -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Session</label>

                    <select wire:model.live="session"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('session') border-red-600 @enderror">

                        <option value="">Choisir un session</option>
                        @if ($this->SessionNiveauFaculteProf->isNotEmpty())
                            @foreach ($this->SessionNiveauFaculteProf as $session=>$cours)
                                <option value="{{ $session }}">{{ $session }}</option> 
                            @endforeach
                        @endif
                        
                    </select>

                    @error('session')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- 🔷 Ligne 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- COURS -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Cours</label>

                    <select wire:model.live="cours"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('cours') border-red-600 @enderror">

                        <option value="">Choisir un cours</option>
                        @foreach ($this->Cours as $cours)
                            <option value="{{ $cours->codeCours }}">{{ $cours->nom }}</option>
                        @endforeach
                    </select>

                    @error('cours')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                

                <!-- ANNEE -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Année académique</label>

                    <input @readonly(true) wire:model.live="anneAcademique" type="text"
                        placeholder="2025-2026"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('anneAcademique') border-red-600 @enderror">

                    @error('anneAcademique')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- 🔷 Ligne 3 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- DATE -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Date de remise</label>

                    <input wire:model.live="dateRemise" type="date"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('dateRemise') border-red-600 @enderror">

                    @error('dateRemise')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PDF -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Fichier PDF</label>

                    <input wire:model.live="pdf" type="file"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white
                        @error('pdf') border-red-600 @enderror">

                    @error('pdf')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- 🔷 DESCRIPTION -->
            <div>
                <label class="text-gray-700 dark:text-gray-200">Description</label>

                <textarea wire:model.live="description" rows="4"
                    class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                    @error('description') border-red-600 @enderror"></textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 🔘 BUTTON -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-ugnh-blueFonce text-white rounded-lg hover:bg-ugnh-blueHover transition">
                    Publier le devoir
                </button>
            </div>

        </form>

    </div>
</section>