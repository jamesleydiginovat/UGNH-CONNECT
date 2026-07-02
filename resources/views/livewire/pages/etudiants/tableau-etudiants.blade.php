<div class="mx-3 text-gray-700  dark:text-gray-300 bg-white dark:bg-gray-900 dark:border dark:border-gray-600 rounded-t-lg p-3   ">
	{{-- <h2 class="mb-4 text-2xl font-semibold leading-tight">
		<font dir="auto" style="vertical-align: inherit;">
			<font dir="auto" style="vertical-align: inherit;">Factures</font>
		</font>
	</h2> --}}
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

        
		<div  :class="!inpuRecherche ? '' : 'md:hidden'" @class([
			'flex flex-col gap-1 w-full',
			'md:flex-row md:items-center md:justify-between md:w-auto'
		])>

			<div class="flex flex-col sm:flex-row gap-1 w-full">

				<div @class([
					'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full'
				])>
					<div @class(['bg-ugnh-blueFonce p-1 rounded'])>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
						<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
						</svg>
					</div>

					<select wire:model.live="filterSexe" @class([
						'outline-0 text-gray-600 w-full',
						'dark:text-ugnh-blueClair dark:border-gray-600'
					])>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="">Sexe</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="M">M</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="F">F</option>
					</select>
				</div>


				<div @class([
					'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full'
				])>
					<div @class(['bg-ugnh-blueFonce p-1 rounded'])>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
						<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
						</svg>
					</div>

					<select wire:model.live="niveau" @class([
						'outline-0 text-gray-600 w-full',
						'dark:text-ugnh-blueClair dark:border-gray-600'
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


			<div class="flex flex-col sm:flex-row gap-1 w-full">

				<div @class([
					'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full'
				])>
					<div @class(['bg-ugnh-blueFonce p-1 rounded'])>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
						<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
						</svg>
					</div>

					<select wire:model.live="faculte" @class([
						'outline-0 text-gray-600 w-full',
						'dark:text-ugnh-blueClair dark:border-gray-600'
					])>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="">Faculte</option>
						@foreach ($this->Facultes as $faculte)
							<option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
						@endforeach
					</select>
				</div>


				<div @class([
					'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full'
				])>
					<div @class(['bg-ugnh-blueFonce p-1 rounded'])>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
						<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
						</svg>
					</div>

					<select wire:model.live="status" @class([
						'outline-0 text-gray-600 w-full',
						'dark:text-ugnh-blueClair dark:border-gray-600'
					])>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="">Status</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="Postulant">Postulant</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="Expulsé">Expulsé</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="Gradué">Gradué</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="Abandonner">Abandonner</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="Supprimer">Supprimer</option>
						<option class="dark:text-gray-200 dark:bg-gray-600" value="Suspendu">Suspendu</option>
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
						<p>Sexe</p>
					</th>
					<th class="px-1 py-3 ">
						<p>Faculte</p>
					</th>
					<th class="px-1 py-3">
						<p>Niveau</p>
					</th>

                    <th class="px-1 py-3 w-20 text-center">
						<p>Action</p>
					</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($this->LesEtudiants as $etudiant )
					
				
					<tr class="border-b border-[#ccc] hover:bg-ugnh-blueClair dark:border-gray-700 dark:hover:bg-gray-800">
						<td class="p-1">
							<p>{{ $etudiant->matricule }}</p>
						</td>
						<td class="p-1">
							<p> {{ $etudiant->nom }}</p>
						</td>
						<td class="p-1">
							<p>{{ $etudiant->prenom }}</p>
							{{-- <p class="text-gray-400 dark:text-gray-600">
								<font dir="auto" style="vertical-align: inherit;">
									<font dir="auto" style="vertical-align: inherit;">Vendredi</font>
								</font>
							</p> --}}
						</td>
						<td class="p-1">
							<p>{{ $etudiant->sexe }}</p>
							{{-- <p class="text-gray-400 dark:text-gray-600">
								<font dir="auto" style="vertical-align: inherit;">
									<font dir="auto" style="vertical-align: inherit;">Mardi</font>
								</font>
							</p> --}}
						</td>
						<td class="p-1">
							<p>{{ $etudiant->faculte->first()?->nom ?? '' }}</p>
							{{-- <p>
								<font dir="auto" style="vertical-align: inherit;">
									<font dir="auto" style="vertical-align: inherit;">15 792 $</font>
								</font>
							</p> --}}
						</td>
						<td class="p-1 ">
							<p>{{ $etudiant->niveau }}</p>
							{{-- <span class="px-3 py-1 font-semibold rounded-md bg-violet-400 dark:bg-violet-600 text-gray-900 dark:text-gray-50">
								<span>
									<font dir="auto" style="vertical-align: inherit;">
										<font dir="auto" style="vertical-align: inherit;">En attente</font>
									</font>
								</span>
							</span> --}}
						</td>


						<td class="p-1 flex flex-row  justify-center">

							<svg wire:click="remplirFromModifier({{ $etudiant->id }})" @click="form = !form, $dispatch('open-modal')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer hover:text-ugnh-blueFonce">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
							</svg>

							{{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
							<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
							</svg> --}}


							<div x-data="{ open: false }" class=" inline-block">

								<!-- Bouton (les 3 points) -->
								<button @click="open = !open" class=" rounded hover:bg-gray-200 dark:hover:bg-gray-700">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
										stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
										<path stroke-linecap="round" stroke-linejoin="round" 
										d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
									</svg>
								</button>

								<!-- Menu -->
								<div 
									x-show="open" 
									@click.outside="open = false"
									x-transition
									class="absolute right-0 mt-2  bg-white dark:bg-gray-800 rounded-lg shadow-lg z-50"
								>
									@if ($this->status=="Postulant")

										<ul class="py-2 text-sm text-gray-700 dark:text-gray-200">

											<li>
												<button wire:click="changerStatus('Etudiant',{{ $etudiant->id }} )" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
													Admission réussit
												</button>
											</li>


											<li>
												<button wire:click="deletePostulant({{ $etudiant->id }} )" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
													Admission Echouée
												</button>
											</li>

										</ul>
									@elseif ($this->status=="Supprimer")

										<ul class="py-2 text-sm text-gray-700 dark:text-gray-200">

											<li>
												<button wire:click="RecupererEtudiant('Etudiant',{{ $etudiant->id }} )" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
													Recuperé
												</button>
											</li>

										</ul>
										
									@else
										<ul class="py-2 text-sm text-gray-700 dark:text-gray-200">

										{{-- <li>
											<a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
												Status
											</a>
										</li> --}}

										<li>
											<button wire:click="changerStatus('Expulsé',{{ $etudiant->id }} )" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
												Expulsé
											</button>
										</li>

										{{-- <li>
											<button wire:click="changerStatus('Gradué',{{ $etudiant->id }})" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
												Gradué
											</button>
										</li> --}}

										<li>
											<button wire:click="changerStatus('Abandonner',{{ $etudiant->id }})" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
												Abandonner
											</button>
										</li>

										<li>
											<button wire:click="changerStatus('Supprimer',{{ $etudiant->id }})" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
												Supprimer
											</button>
										</li>

										<li>
											<button wire:click="changerStatus('Suspendu',{{ $etudiant->id }})" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
												Suspendu
											</button>
										</li>

									</ul>
									@endif
									
								</div>
							</div>

							


						</td>
					</tr>

				@endforeach


                


			</tbody>
		</table>
	</div>




	@if ($this->LesEtudiants->isEmpty())
            <div class=" mt-10 mb-10 flex w-full m-auto max-w-sm overflow-hidden rounded-lg shadow-md dark:bg-gray-700 bg-white">
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
							Aucun Etudiant trouvé.
						@else
							Aucun Etudiant enregistré. Veuillez ajouter des Etudiants!
						@endif</p>
					</div>
				</div>
			</div>
        
    @endif
			

    @if ($this->LesEtudiants->isNotEmpty())
        <div class="mt-4 bottom-0 w-full left-0">
            {{ $this->LesEtudiants->links('pagination::tailwind') }}
        </div>
    @endif



	    {{-- <div class="mt-4 absolute bottom-0 w-full left-0 p-5">
        {{ links('pagination::tailwind') }}
    </div> --}}
</div>