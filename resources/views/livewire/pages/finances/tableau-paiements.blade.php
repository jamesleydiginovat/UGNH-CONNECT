<div class="mx-3 text-gray-700  dark:text-gray-300 bg-white dark:bg-gray-900 dark:border dark:border-gray-600 p-3 rounded-t-lg ">
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
            <input wire:model.live="search" :class="!inpuRecherche ? 'w-full p-1 pe-8  lg:w-full lg:p-1 lg:pe-8' : 'w-full p-1 pe-8'" class=" bg-blue-50 dark:bg-gray-600 shadow-sm rounded  outline-0  dark:text-gray-300 dark:border-gray-600 " type="text" name="" id="" placeholder="Rechercher">
            <div @click="inpuRecherche= !inpuRecherche"  @class(['bg-ugnh-blueFonce p-1 right-0 rounded absolute md:me-1 me-2 lg:me-1 '])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4  text-gray-50">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>

        
        <div
            :class="!inpuRecherche ? '' : 'md:hidden'"
            @class([
                'flex flex-col gap-2 w-full',
                'lg:flex-row md:items-center md:justify-between md:w-auto'
            ])
        >

            <!-- GROUPE 1 -->
            <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">

                <!-- ANNÉE ACADÉMIQUE -->
                <div @class([
                    'flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto'
                ])>

                    <div class="bg-ugnh-blueFonce p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4 text-gray-50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>

                    <select
                        wire:model.live="byAnneeAccademique"
                        @class([
                            'outline-0 text-gray-600 w-full sm:w-auto',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                        ])
                    >
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Année académique</option>
                        @foreach ($this->AnneeAccademique as $anneAcc)
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $anneAcc->libelle }}">{{ $anneAcc->libelle }}</option>
                        @endforeach
                    </select>

                </div>

                <!-- NIVEAU -->
                <div @class([
                    'flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto'
                ])>

                    <div class="bg-ugnh-blueFonce p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4 text-gray-50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>

                    <select wire:model.live="byNiveau"
                        @class([
                            'outline-0 text-gray-600 w-full sm:w-auto',
                            'dark:text-ugnh-blueClair'
                        ])>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Niveau</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="3">III</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="4">IV</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="5">V</option>
                    </select>

                </div>

            </div>

            <!-- GROUPE 2 -->
            <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">

                <!-- FACULTÉ -->
                <div @class([
                    'flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto'
                ])>

                    <div class="bg-ugnh-blueFonce p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4 text-gray-50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>

                    <select wire:model.live="byFaculte"
                        @class([
                            'outline-0 text-gray-600 w-full sm:w-auto',
                            'dark:text-ugnh-blueClair'
                        ])>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Faculté</option>
                        @foreach ($this->Facultes as $faculte)
                            <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                        @endforeach
                    </select>

                </div>

                <!-- SESSION -->
                <div @class([
                    'flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto'
                ])>

                    <div class="bg-ugnh-blueFonce p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-4 h-4 text-gray-50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>

                    <select wire:model.live="bySession"
                        @class([
                            'outline-0 text-gray-600 w-full sm:w-auto',
                            'dark:text-ugnh-blueClair'
                        ])>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="">Session</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                    </select>

                </div>

            </div>

        </div>


    </div>
    
	<div class="overflow-x-auto no-scrollbar  ">
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
						<p>Niveau</p>
					</th>
					<th class="px-1 py-3">
						<p>Session</p>
					</th>
                    <th class="px-1 py-3">
						<p>1er Versement</p>
					</th>
                    <th class="px-1 py-3">
						<p>2eme Versement</p>
					</th>
                    <th class="px-1 py-3">
						<p>3eme Versement</p>
					</th>
                    <th class="px-1 py-3">
						<p>Total</p>
					</th>

                    <th class="px-1 py-3 w-20 text-center">
						<p>Action</p>
					</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($this->Paiements as $paiement )
                
                    @php
                        $p1 = floatval($paiement->premierVersement);
                        $prix1 = floatval($paiement->prixVersement1 ?? 0);
                        $pct1 = $prix1 > 0 ? round(($p1 / $prix1) * 100, 2) : 0;

                        $p2 = floatval($paiement->deuxiemeVersement);
                        $prix2 = floatval($paiement->prixVersement2 ?? 0);
                        $pct2 = $prix2 > 0 ? round(($p2 / $prix2) * 100, 2) : 0;

                        $p3 = floatval($paiement->troisiemeVersement);
                        $prix3 = floatval($paiement->prixVersement3 ?? 0);
                        $pct3 = $prix3 > 0 ? round(($p3 / $prix3) * 100, 2) : 0;

                        $total = floatval($paiement->total);
                        $prixTotal = floatval($paiement->prixTotal ?? 0);
                        $pctTotal = $prixTotal > 0 ? round(($total / $prixTotal) * 100, 2) : 0;
                    @endphp
					
				
					<tr class="border-b border-[#ccc] dark:border-gray-600  hover:bg-green-200 dark:hover:text-gray-700">
						<td class="p-1 font-bold text-ugnh-blueFonce dark:text-yellow-500">
							<p>{{ $paiement->matriculeEtudiant }}</p>
                            {{-- <p>00000000</p> --}}
						</td>
						<td class="p-1">
							<p>{{ $paiement->etudiant->nom }}</p>
                            {{-- <p>Philippe</p> --}}
						</td>
						<td class="p-1">
							<p>{{ $paiement->etudiant->prenom }}</p>
                            {{-- <p>Jamesley</p> --}}
						</td>
						<td class="p-1">
							<p>{{ $paiement->etudiant->faculte->first()?->nom ?? ''}}</p>
                            {{-- <p>Sc. Informatique</p> --}}
						</td>
						<td class="p-1">
							<p>{{ $paiement->niveau }}</p>
                            {{-- <p>V</p> --}}
						</td>
						<td class="p-1 ">
							<p>{{ $paiement->session }}</p>
                            {{-- <p>I</p> --}}
						</td>

                    <td class="p-1 relative border-r border-gray-600 bg-green-200 dark:text-gray-900">
                        <!-- Premier versement -->
                        <div style="width: {{ $pct1 }}%;" class="bg-green-400 w-[10%] h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                            <p class="absolute font-bold">+{{ $p1 }}<br><span class="font-normal">{{ $pct1 }}%</span></p>
                        </div>
                    </td>

                    <td class="p-1 relative border-r border-gray-600 bg-green-200 dark:text-gray-900"">
                        <!-- Deuxième versement -->
                        <div style="width: {{ $pct2 }}%;" class="bg-green-400 w-[10%] h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                            <p class="absolute font-bold">+{{ $p2 }}<br><span class="font-normal">{{ $pct2 }}%</span></p>
                        </div>
                    </td>

                    <td class="p-1 relative border-r border-gray-600 bg-green-200 dark:text-gray-900"">
                        <!-- Troisième versement -->
                        <div style="width: {{ $pct3 }}%;" class="bg-green-400 w-[10%] h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                            <p class="absolute font-bold">+{{ $p3 }}<br><span class="font-normal">{{ $pct3 }}%</span></p>
                        </div>
                    </td>

                    <td class="p-1 relative border-r border-gray-600 bg-green-200 dark:text-gray-900"">
                        <!-- Total -->
                        <div style="width: {{ $pctTotal }}%;" class="bg-green-400 h-full absolute top-0 left-0 transition-all ease-in-out duration-300">
                            <p class="absolute font-bold">+{{ $total }}<span class="font-normal"> {{ $pctTotal }}%</span></p>
                        </div>
                    </td>


						<td class="p-1 flex flex-row justify-center">
                            {{-- wire:click="remplirFromModifier({{ $etudiant->id }})" --}}
							{{-- <svg  @click="form = !form, $dispatch('open-modal')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer hover:text-ugnh-blueFonce">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
							</svg> --}}
                            <button @click="tableSlideNote = !tableSlideNote, $dispatch('open-modal')" wire:click="sessionDetail('{{  $paiement->matriculeEtudiant }}', '{{ $paiement->niveau }}')"  class="hover:cursor-pointer hover:bg-ugnh-blueFonce dark:border-yellow-500 dark:text-yellow-500  hover:text-gray-50 transition-all ease-in-out duration-300 flex flex-row gap-1 p-1 text-ugnh-blueFonce  rounded-lg border border-ugnh-blueFonce">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                            <path fill-rule="evenodd" d="M6 4.75A.75.75 0 016.75 4h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 4.75zM6 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75A.75.75 0 016 10zm0 5.25a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H6.75a.75.75 0 01-.75-.75zM1.99 4.75a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1v-.01zM1.99 15.25a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1v-.01zM1.99 10a1 1 0 011-1H3a1 1 0 011 1v.01a1 1 0 01-1 1h-.01a1 1 0 01-1-1V10z" clip-rule="evenodd" />
                            </svg> --}}
                            Détails</button>

						</td>
					</tr>

				@endforeach


                


			</tbody>
		</table>
	</div>



     @if ($this->Paiements->isEmpty())
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
                            @if ($search !="")
							Aucun paiement trouvé pour cette annee academique.
						@else
							Aucun paiement effecteur pour cette annee academique.!
						@endif</p>
					</div>
				</div>
			</div>
        
    @endif

	{{-- @if ($this->LesEtudiants->isEmpty())
            <div class=" mt-10 mb-10 flex w-full m-auto max-w-sm overflow-hidden rounded-lg shadow-md bg-white">
				<div class="flex items-center justify-center w-12 bg-[#00b4d8]">
					<svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
						<path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
					</svg>
				</div>

				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-[#00b4d8]">Info</span>
						<p class="text-sm text-gray-700">
                            @if ($search !="")
							Aucun Etudiant trouvé.
						@else
							Aucun Etudiant enregistré. Veuillez ajouter des Etudiants!
						@endif</p>
					</div>
				</div>
			</div>
        
    @endif --}}
			

    @if ($this->Paiements->isNotEmpty())
        <div class="mt-4 bottom-0 w-full left-0">
            {{ $this->Paiements->links('pagination::tailwind') }}
        </div>
    @endif



	    {{-- <div class="mt-4 absolute bottom-0 w-full left-0 p-5">
        {{ links('pagination::tailwind') }}
    </div> --}}
</div>