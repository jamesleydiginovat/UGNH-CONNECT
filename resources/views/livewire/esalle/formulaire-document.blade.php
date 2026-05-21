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
            Publication de document
        </h2>

        <form wire:submit="saveDocument" class="space-y-6">

            <!-- 🔷 Ligne 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- CODE -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Titre du document</label>

                    <input  wire:model.live="titre" type="text"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('titre') border-red-600 @enderror">

                    @error('titre')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <div>
                    <label class="text-gray-700 dark:text-gray-200">Faculte</label>

                    <select wire:model.live="codeFac"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('codeFac') border-red-600 @enderror">
                        
                        <option value="">Choisir un faculte</option>
                        @foreach ($this->faculteProf as $codeFac => $coursList)
                            <option value="{{ $codeFac }}">{{ $coursList->first()->faculte->nom ?? 'Faculté inconnue' }}</option>
                        @endforeach
                    </select>

                    @error('codeFac')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>



                

            </div>

            <!-- 🔷 Ligne 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Niveau</label>

                    <select wire:model.live="niveau"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('niveau') border-red-600 @enderror">

                        <option value="">Choisir un niveau</option>
                        @foreach ($this->LesNiveaufaculteProf as $niveaux => $coursList)
                            <option value="{{ $niveaux }}">{{ $niveaux }}</option>
                        @endforeach
                    </select>

                    @error('niveau')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Session</label>

                    <select wire:model.live="session"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('session') border-red-600 @enderror">

                        <option value="">Choisir une session</option>
                        @foreach ($this->LesSessionfaculteProf as  $session => $coursList)
                            <option value="{{ $session }}">{{ $session }}</option>
                        @endforeach
                    </select>

                    @error('session')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
                <!-- TITRE -->
                <div>
                    <label class="text-gray-700 dark:text-gray-200">Cours</label>

                    <select wire:model.live="codeCours"
                        class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300
                        @error('cours') border-red-600 @enderror">

                        <option value="">Choisir un cours</option>
                        @foreach ($this->CoursfaculteProf as  $coursList)
                                <option value="{{ $coursList->codeCours }}">{{ $coursList->nom }}</option>
                        @endforeach
                    </select>

                    @error('cours')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 🔷 Ligne 3 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                

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

            
            <!-- 🔘 BUTTON -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-ugnh-blueFonce text-white rounded-lg hover:bg-ugnh-blueHover transition">
                    Publier le document
                </button>
            </div>

        </form>

    </div>
</section>