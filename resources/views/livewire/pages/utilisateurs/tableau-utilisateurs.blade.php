<div class="mx-3 text-gray-700  dark:text-gray-300  bg-white dark:border-gray-700 dark:border dark:bg-gray-900 rounded-t-lg p-3 ">
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

        
    <div class="flex flex-col sm:flex-row gap-1 w-full">
                                
        <div @class([
            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-1/3'
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
            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-1/3'
        ])>
            <div @class(['bg-ugnh-blueFonce p-1 rounded'])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>
            </div>

            <select wire:model.live="filterFonction" @class([
                'outline-0 text-gray-600 w-full',
                'dark:text-ugnh-blueClair dark:border-gray-600'
            ])>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Fonction</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="Administrateur">Administrateur</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="Secretaire">Secretaire</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="Comptable">Comptable</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="Vice Doyen">Vice Doyen</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="Bibliothecaire">Bibliothecaire</option>
            </select>
        </div>

        <div @class([
            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-1/3'
        ])>
            <div @class(['bg-ugnh-blueFonce p-1 rounded'])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>
            </div>

            <select wire:model.live="filterStatut" @class([
                'outline-0 text-gray-600 w-full',
                'dark:text-ugnh-blueClair dark:border-gray-600'
            ])>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="">Status</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="1">En ligne</option>
                <option class="dark:text-gray-200 dark:bg-gray-600" value="0">Hors ligne</option>
            </select>
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
					<th class="px-1 py-3 text-nowrap">
						<p>Nom utilisateur</p>
					</th>
					<th class="px-1 py-3 ">
						<p>Sexe</p>
					</th>
					<th class="px-1 py-3">
						<p>Fonction</p>
					</th>

                    <th class="px-1 py-3 text-center">
						<p>Status</p>
					</th>

                    <th class="px-1 py-3 w-20 text-center">
						<p>Action</p>
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($this->Utilisateurs as $Utilisateur )
					<tr class=" hover:bg-ugnh-blueClair dark:hover:bg-gray-800 transition-all duration-200 ease-in-out  border-b border-[#ccc] dark:border-gray-800">

                    <td class=" p-1">
                        <div class="rounded-full border border-ugnh-blueHover text-ugnh-blueHover h-10  w-10 overflow-hidden ">
                            <img
                            class="h-10 w-10 object-cover" 
                            src="{{ Storage::url("profileUtilisateur/".$Utilisateur->photo) }}"
                            alt="vide"
                            srcset=""
                            >
                        </div>
						
					</td>

					<td class="p-1">
						<p>{{ $Utilisateur->code }}</p>
					</td>
					<td class="p-1">
						<p> {{$Utilisateur->nom}}</p>
					</td>
					<td class="p-1">
						<p>{{$Utilisateur->prenom}}</p>
					</td>
					
					<td class="p-1">
                        <p>{{$Utilisateur->nomUtilisateur}}</p>
					</td>


                    <td class="p-1">
						<p>{{$Utilisateur->sexe}}</p>
					</td>

					<td class="p-1 ">
                        <p>{{$Utilisateur->fonction}}</p>
					</td>



                    <td class="p-1 bg-ugnh-blueClair dark:bg-gray-700 text-center">
                        @if ($Utilisateur->statut ==1)
                            <span class=" px-3 py-1 font-semibold rounded-md bg-green-300  text-gray-600 ">
                                <span>
                                    <font dir="auto" style="vertical-align: inherit;">
                                        <font dir="auto" style="vertical-align: inherit;">En ligne</font>
                                    </font>
                                </span>
						    </span>
                        @else
                            <span class=" px-3 py-1 font-semibold rounded-md bg-red-400  text-gray-100 ">
                                <span>
                                    <font dir="auto" style="vertical-align: inherit;">
                                        <font dir="auto" style="vertical-align: inherit;">Hors ligne</font>
                                    </font>
                                </span>
						    </span>
                        @endif
						
					</td>


                    <td class="p-1 flex flex-row justify-center">
                        {{-- <svg wire:click="sessionEdit({{ $Utilisateur->nomUtilisateur }})" @click="form = !form, $dispatch('open-modal')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg> --}}

                        <svg wire:click="selectionUtilisateur('{{ $Utilisateur->nomUtilisateur }}')" @click="modalConfirmation = !modalConfirmation"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </td>
				</tr>
					
				@endforeach
				


                

                


                


                


            
			</tbody>
		</table>
	</div>



	{{-- @if ($this->Personnels->isNotEmpty()) --}}
        <div class="mt-4 bottom-0 w-full left-0">
            {{ $this->Utilisateurs->links('pagination::tailwind') }}
        </div>
    {{-- @endif --}}





    {{-- modal confirmation  --}}
     <section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
    ])
    x-show="modalConfirmation"
    x-transition.duration.300ms
    >



    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-30 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white relative rounded-lg p-5 dark:bg-gray-800 lg:min-w-[40%]  sm:min-w-[50%] sm:w-auto w-[93%]  h-auto  shadow-2xl overflow-y-auto ">
         
            <div @class(['absolute z-50 top-0 right-0   cursor-pointer  rounded-tr-lg p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
            @click="modalConfirmation = !modalConfirmation"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div> 
            
            <div class="flex sm:flex-row  flex-col">
                <div class="relative w-full sm:w-20  ">
                    <div class=" sm:bg-red-200 sm:absolute flex justify-center sm:p-2 rounded-full top-0 left-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-center text-red-600 ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                </div>

                <div class="">
                    <h1 class="font-bold ">Suppression de l'utilisateur</h1>
                    <p>Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.</p>

                    <div class=" mt-5 flex fle-col gap-3 sm:justify-end justify-between">
                        <button wire:click="deleteUser({{ $this->utilisateurSelectionner }})"  @click="modalConfirmation = !modalConfirmation" class="bg-red-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-red-400">Supprimer</button>
                        <button @click="modalConfirmation = !modalConfirmation" class="bg-gray-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-gray-400">Annuler</button>
                    </div>
                </div>
             </div>
        </div>

    </div>
    
</section>

</div>