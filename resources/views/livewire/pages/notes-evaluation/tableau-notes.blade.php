<div class="mx-3 text-gray-700  dark:text-gray-300 p-3 bg-white dark:bg-gray-900 dark:border dark:border-gray-600 rounded-t-lg ">
	{{-- <h2 class="mb-4 text-2xl font-semibold leading-tight">
		<font dir="auto" style="vertical-align: inherit;">
			<font dir="auto" style="vertical-align: inherit;">Factures</font>
		</font>
	</h2> --}}
    <div @class([
        'flex flex-col items-center justify-between gap-2 bg-ugnh-blueClair py-5 px-1 rounded-t border-b border-[#ccc]',
		'md:rounded-t-lg lg:flex-row',
		'dark:bg-gray-700 dark:border-gray-600'
    ])>

        <div 
		:class="!inpuRecherche ? '  rounded lg:w-full lg:bg-transparent lg:p-0  lg:shadow-none w-full' : 'w-full'"
		@class([
			"flex flex-row items-center relative  ",
			''
		])>
            <input wire:model.live="search" :class="!inpuRecherche ? 'w-full p-1 pe-8  lg:w-full lg:p-1 lg:pe-8' : 'w-full p-1 pe-8'" class=" bg-blue-50 dark:bg-gray-600 shadow-sm rounded  outline-0  dark:text-gray-300 dark:border-gray-600 " type="text" name="" id="" placeholder="Matricule / Nom / Prenom">
            <div @click="inpuRecherche= !inpuRecherche"  @class(['bg-ugnh-blueFonce p-1 right-0 rounded absolute md:me-1 me-2 lg:me-1 '])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4  text-gray-50">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>

        
    <div  :class="!inpuRecherche ? '' : 'md:hidden'" 
        @class([
            'flex flex-col gap-2 w-full',
            'lg:flex-row lg:items-center lg:justify-between'
        ])>

        <div class="flex flex-col lg:flex-row gap-2 w-full">

            <!-- Faculte -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full lg:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="codeFac"
                    class="outline-0 text-gray-600 dark:text-ugnh-blueClair w-full bg-transparent">
                    <option value="">Faculte</option>
                    @foreach ($this->Facultes as $faculte)
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Niveau -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full lg:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="niveau"
                    class="outline-0 text-gray-600 dark:text-ugnh-blueClair w-full bg-transparent">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">Niveau</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600"value="3">III</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600"value="4">IV</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600"value="5">V</option>
                </select>
            </div>

            <!-- Session -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full lg:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="session"
                    class="outline-0 text-gray-600 dark:text-ugnh-blueClair w-full bg-transparent">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="1">Session I</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="2">Session II</option>
                </select>
            </div>

            <!-- Année académique -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full lg:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="anneAcademique"
                    class="outline-0 text-gray-600 dark:text-ugnh-blueClair w-full bg-transparent">
                    <option value="">Année académique</option>
                    @foreach ($this->AnneeAccademique as $anneAcc)
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $anneAcc->libelle }}">{{ $anneAcc->libelle }}</option>
                    @endforeach
                </select>
            </div>

        </div>

    </div>


    </div>

	<div class="overflow-x-auto  ">
		<table class="min-w-full text-xs ">
			<thead class="bg-ugnh-blueClair dark:bg-gray-700 ">
				<tr class="text-left  ">
					<th class="px-1 py-3">
						<p>Matricule</p>
					</th>
					<th class="px-1 py-3">
						<p>Nom</p>
					</th>
					<th class="px-1 py-3">
						<p>Prenom</p>
					</th>
					<th class="px-1 py-3">
						<p>Faculte</p>
					</th>
					<th class="px-1 py-3 ">
						<p>Note Total</p>
					</th>
					<th class="px-1 py-3">
						<p>Coefficient</p>
					</th>

                    <th class="px-1 py-3">
						<p>Moyenne</p>
					</th>

                    <th class="px-1 py-3">
						<p>Reprise</p>
					</th>

                    <th class="px-1 py-3 w-20 text-center">
						<p>Action</p>
					</th>
				</tr>
			</thead>
			<tbody>
            @foreach ($this->LesNotes as $matricule => $etudiantNotes)

                @php
                    $totalNotes = 0;
                    $totalCoef = 0;
                    $reprise = 0;
                @endphp     

                @foreach ($etudiantNotes as $note)

                    @php
                        // 🔹 Calcul note finale
                        $noteFinale = $note->noteIntra + $note->examenFinal;

                        // 🔥 Compter les matières à reprendre
                        if ($noteFinale < 65 && $note->noteRattrapage === null && $note->noteIntra!=null && $note->examenFinal!=null  ) {
                            $reprise++;
                        }

                        // 🔹 Si rattrapage existe → on remplace la note
                        // if ($noteFinale < 65 && $note->noteRattrapage !== null) {
                        //     $noteFinale = $note->noteRattrapage;
                        // }

                        // 🔹 Coefficient (fixe ou dynamique)
                        $coef = 100; // ou $note->cours->coefficient

                        $totalNotes += $noteFinale;
                        $totalCoef += $coef;
                    @endphp

                @endforeach

                @php
                    $moyenne = $totalCoef > 0 ? ($totalNotes / $totalCoef)*10 : 0;
                    $etudiant = $etudiantNotes->first();
                @endphp

                <tr class="border-b border-[#ccc] dark:border-gray-600 hover:bg-ugnh-blueClair transition-all duration-200 ease-in-out  dark:hover:bg-gray-800">

                    <!-- Matricule -->
                    <td class="p-1">
                        <p>{{ $matricule }}</p>
                    </td>

                    <!-- Nom -->
                    <td class="p-1">
                        <p>{{ $etudiant->etudiant->nom ?? '---' }}</p>
                    </td>

                    <!-- Prénom -->
                    <td class="p-1">
                        <p>{{ $etudiant->etudiant->prenom ?? '---' }}</p>
                    </td>

                    <!-- Faculté / Niveau / Session -->
                    <td class="p-1">
                        <p>{{ $etudiant->faculte->nom ?? '---' }}</p>
                        <p class="text-gray-400">Niveau: {{ $etudiant->niveau }}</p>
                        <p class="text-gray-400">Session: {{ $etudiant->session }}</p>
                    </td>

                    <!-- Note totale -->
                    <td class="p-1">
                        <p>{{ $totalNotes }}</p>
                    </td>

                    <!-- Coefficient -->
                    <td class="p-1">
                        <p>{{ $totalCoef }}</p>
                    </td>

                    <!-- Moyenne -->
                    <td class="p-1">
                        <p>{{ number_format($moyenne, 2) }}</p>
                    </td>

                    <!-- Reprise (nombre réel) -->
                    <td class="p-1">
                        <p>{{ $reprise > 0 ? $reprise : '-' }}</p>
                    </td>

                    <!-- Actions -->
                    
                    <td class="p-1 ">
                        <svg wire:click="sessionNoteByEtudiant('{{ $matricule }}', '{{ $etudiant->niveau }}','{{ $etudiant->faculte->codeFac ?? '---'}}')"  @click="tableSlideNoteByStudent = !tableSlideNoteByStudent, $dispatch('open-modal')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-6 cursor-pointer text-center ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </td>


                </tr>

            @endforeach

			</tbody>
		</table>
	</div>




    	   @if ($this->LesNotes->isEmpty())
            <div class=" mt-10 mb-10 flex w-full m-auto max-w-sm overflow-hidden rounded-lg shadow-md bg-white dark:bg-gray-700">
				<div class="flex items-center justify-center w-12 bg-yellow-500">
					<svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
						<path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
					</svg>
				</div>

				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-yellow-500">Info</span>
						<p class="text-sm text-yellow-500">
                        {{-- @if ($search !="")
							Aucun notes trouvé dans cette annee academique.
						@else --}}
							Aucun note enregistré dans cette annee academique !
						{{-- @endif --}}
                    </p>
					</div>
				</div>
			</div>
        
        @endif

</div>
   


