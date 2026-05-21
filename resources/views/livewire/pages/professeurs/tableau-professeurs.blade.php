<div class="mx-3 text-gray-700  dark:text-gray-300 bg-white dark:bg-gray-900 dark:border dark:border-gray-600 rounded-t-lg p-3   ">

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
                'flex flex-row items-center justify-between gap-1 w-full',
				'md:w-auto'
            ])>

                    
                        {{-- <h1 @class([' rounded-xl bg-ugnh-blueFonce w-10'])>..</h1> --}}
						<div class="flex flex-col sm:flex-row gap-1">
							
                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce p-1 rounded'])>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>
                            

                            <select wire:model.live="filterSexe" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ]) name="" id="">
                                <option class="dark:text-ugnh-blueFonce" value="">Sexe</option>
                                <option class="dark:text-ugnh-blueFonce" value="M">M</option>
                                <option class="dark:text-ugnh-blueFonce" value="F">F</option>
                                {{-- <option class="dark:text-ugnh-blueFonce" value="">...</option> --}}
                            </select>
                        </div>
						</div>


            </div>


			<div  :class="!inpuRecherche ? '' : 'md:hidden'" @class([
                'flex flex-row items-center justify-between gap-1 w-full',
				'md:w-auto'
            ])>

                    
                        {{-- <h1 @class([' rounded-xl bg-ugnh-blueFonce w-10'])>..</h1> --}}
						<div class="flex flex-col sm:flex-row gap-1">
							
                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1'
                        ])>
                            <div @class(['bg-ugnh-blueFonce p-1 rounded'])>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50  ">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>
                            

                            <select wire:model.live="filterStatus" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ]) name="" id="">
                                <option class="dark:text-ugnh-blueFonce" value="">Status</option>
                                <option class="dark:text-ugnh-blueFonce" value="Retraité">Retraité</option>
								<option class="dark:text-ugnh-blueFonce" value="Suspendu">Suspendu</option>
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
						<p></p>
					</th>
					<th class="px-1 py-3">
						<p>Code</p>
					</th>
					<th class="px-1 py-3">
						<p>Nom</p>
					</th>
					<th class="px-1 py-3">
						<p>Prenom</p>
					</th>
					{{-- <th class="px-1 py-3 text-nowrap">
						<p>Nom utilisateur</p>
					</th> --}}
					<th class="px-1 py-3 ">
						<p>Sexe</p>
					</th>
					<th class="px-1 py-3">
						<p>Metier</p>
					</th>

                    {{-- <th class="px-1 py-3 text-center">
						<p>Status</p>
					</th> --}}

                    <th class="px-1 py-3 w-20 text-center">
						<p>Action</p>
					</th>
				</tr>
			</thead>
			<tbody>

				@foreach ($this->LesProfesseurs as $professeur)
					
				
					<tr class=" border-b border-[#ccc]  dark:border-gray-800 hover:bg-ugnh-blueClair dark:hover:bg-gray-800">

						<td class=" p-1">
							<div class="rounded-full bg-amber-300 h-10  w-10 overflow-hidden ">
								<img
								class="h-10 w-10 object-cover" 
								src="{{ Storage::url("photosProfesseurs/".$professeur->photo)}}"
								alt=""
								srcset=""
								>
							</div>
							
						</td>

						<td class="p-1">
							<p>{{$professeur->codeProf}}</p>
						</td>
						<td class="p-1">
							<p> {{$professeur->nom}}</p>
						</td>
						<td class="p-1">
							<p>{{$professeur->prenom}}</p>
						</td>

						<td class="p-1">
							<p>{{$professeur->sexe}}</p>
						</td>

						<td class="p-1 ">
							<p>{{$professeur->specialite}}</p>
						</td>

						<td class="p-1 flex flex-row justify-center">
							<svg wire:click="remplirFromModifier({{ $professeur->id }})" @click="form = !form, $dispatch('open-modal')"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
							</svg>

							@php
								$role = Auth::user()->roles->first()->nom ?? '';
								$isAdmin = $role == "Administrateur";
							@endphp

							@if ($isAdmin)
								<div x-data="{ open: false }" class=" inline-block">

									<!-- Bouton (les 3 points) -->
									<button @click="open = !open" class=" cursor-pointer rounded hover:bg-gray-200 dark:hover:bg-gray-700">
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
											<ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
											<li>
												<button wire:click="changerStatus('Supprimé',{{ $professeur->id }} )" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
													Supprimé
												</button>
											</li>

											<li>
												<button wire:click="changerStatus('Retraité',{{ $professeur->id }})" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
													Retraité
												</button>
											</li>

											<li>
												<button wire:click="changerStatus('Suspendu',{{ $professeur->id }})" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
													Suspendu
												</button>
											</li>
											@if($filterStatus !="")
												<li>
													<button wire:click="changerStatus('Actif',{{ $professeur->id }} )" href="#" class="block px-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
														Actif
													</button>
												</li>
											@endif
											

										</ul>
										
									</div>
								</div>
							@endif

						</td>
					</tr>

				@endforeach

                
			</tbody>
		</table>
	</div>


	@if ($this->LesProfesseurs->isEmpty())
            <div class=" mt-10 mb-10 flex w-full m-auto max-w-sm overflow-hidden rounded-lg shadow-md bg-gray-700">
				<div class="flex items-center justify-center w-12 bg-yellow-500">
					<svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
						<path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
					</svg>
				</div>

				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-yellow-500">Info</span>
						<p class="text-sm text-yellow-500 ">
                            @if ($search !="")
							Aucun professeur trouvé.
						@else
							Aucun professeur enregistré. Veuillez ajouter un professeur!
						@endif</p>
					</div>
				</div>
			</div>
    @endif
			

    @if ($this->LesProfesseurs->isNotEmpty())
        <div class="mt-4 bottom-0 w-full left-0">
            {{ $this->LesProfesseurs->links('pagination::tailwind') }}
        </div>
    @endif



	    {{-- <div class="mt-4 absolute bottom-0 w-full left-0 p-5">
        {{ links('pagination::tailwind') }}
    </div> --}}
</div>