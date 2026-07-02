<section class="p-3 m-3 bg-white dark:bg-gray-900 rounded-lg">
    <div @class([
        'flex flex-col items-center justify-between gap-2 bg-ugnh-blueClair py-5 px-1 rounded-t border-b border-[#ccc]',
		'md:rounded-t-lg md:flex-row',
		'dark:bg-gray-700 dark:border-gray-600'
    ])>
       
        <div 
		:class="!inpuRecherche ? 'md:bg-ugnh-blueClair p-1 rounded md:shadow-sm md:w-7  lg:w-full lg:bg-transparent lg:p-0  lg:shadow-none w-full' : 'w-full'"
		@class([
			"flex flex-row items-center relative  ",
			''
		])>
            <input wire:model.live="search" :class="!inpuRecherche ? 'w-full p-1 pe-8  md:w-0 lg:w-full md:p-0 md:pe-0 lg:p-1 lg:pe-8' : 'w-full p-1 pe-8'" class=" bg-blue-50 dark:bg-gray-600 shadow-sm rounded  outline-0  dark:text-gray-300 dark:border-gray-600 " type="text" name="" id="" placeholder="Rechercher">
            <div @click="inpuRecherche= !inpuRecherche"  @class(['bg-ugnh-blueFonce p-1 right-0 rounded absolute md:me-1 me-2 lg:me-1 '])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4  text-gray-50">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>

        
        <div  
            :class="!inpuRecherche ? '' : 'md:hidden'" 
            @class([
                'flex flex-col md:flex-row items-stretch md:items-center gap-2 w-full',
                'md:w-auto'
            ])
        >

            <!-- Faculte -->
            <div @class([
                'flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full md:w-auto'
            ])>
                <div class="bg-ugnh-blueFonce p-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byFaculte"
                    class="outline-0 text-gray-600 w-full bg-transparent dark:text-ugnh-blueClair">
                    <option class="text-gray-200 dark:bg-gray-600" value="">Faculte</option>
                    @foreach ($this->Facultes as $faculte)
                        <option class="dark:text-ugnh-blueFonce" value="{{ $faculte->codeFac }}">
                            {{ $faculte->nom }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Niveau -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full md:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byNiveau"
                    class="outline-0 text-gray-600 w-full bg-transparent dark:text-ugnh-blueClair">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">Niveau</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="1">I</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="2">II</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="3">III</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="4">IV</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="5">V</option>
                </select>
            </div>


            <!-- Statut -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full md:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byStatus"
                    class="outline-0 text-gray-600 w-full bg-transparent dark:text-ugnh-blueClair">
                    <option class="text-gray-200 dark:bg-gray-600" value="">Statut</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="Etudiant">Etudiant</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="Postulant">Postulant</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="Abandon">Abandon</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="Expulse">Expulse</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="Termine">Termine</option>
                    <option class="text-gray-200 dark:bg-gray-600" value="Graduer">Graduer</option>
                </select>
            </div>

        </div>


    </div>


    <div class="mt-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-700 dark:text-gray-100">
                Dossiers des Étudiants
            </h2>

            <div class="bg-indigo-100 dark:bg-ugnh-blueFonce text-ugnh-blueFonce dark:text-indigo-300 px-3 py-1 rounded-full text-xs font-semibold">
                {{ count($this->DossierEtudiants) }} dossiers
            </div>
        </div>

        <!-- Grid -->
        <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5">

            @foreach ($this->DossierEtudiants as $dossier)

                <div
                    wire:click="DossierEtudiant({{ $dossier->id }})"
                    @click="tableSlide = !tableSlide"

                    class="group relative overflow-hidden rounded-xl border border-gray-200 dark:border-gray-600
                    bg-white dark:bg-gray-800 p-3 shadow-sm hover:shadow-lg hover:-translate-y-1
                    transition-all duration-300 cursor-pointer"
                >

                    <!-- Icon -->
                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-ugnh-blueFonce text-white shadow">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                        </div>

                        <!-- Infos -->
                        <div class="min-w-0">

                            <p class="text-[10px] text-gray-400 uppercase">
                                Matricule
                            </p>

                            <p class="font-semibold text-gray-800 dark:text-white text-sm truncate">
                                {{ $dossier->matricule }}
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-300 truncate">
                                {{ $dossier->nom }} {{ $dossier->prenom }}
                            </p>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="mt-2 flex justify-end">
                        <span class="text-[10px] text-ugnh-blueFonce dark:text-ugnh-blueFonce font-semibold">
                            Ouvrir →
                        </span>
                    </div>

                </div>

            @endforeach

        </div>
    </div>
</section>