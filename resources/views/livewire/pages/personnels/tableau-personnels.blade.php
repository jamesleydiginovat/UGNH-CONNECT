<div class="mx-3 text-gray-700  dark:text-gray-300 p-3 bg-white dark:bg-gray-900 rounded-t-lg dark:border dark:border-gray-700 ">
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
            <input wire:model.live="search" :class="!inpuRecherche ? 'w-full p-1 pe-8  md:w-0 lg:w-full md:p-0 md:pe-0 lg:p-1 lg:pe-8' : 'w-full p-1 pe-8'" class=" bg-blue-50 dark:bg-gray-600 shadow-sm rounded  outline-0  dark:text-gray-300 dark:border-gray-600 " type="search" name="" id="" placeholder="Rechercher">
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
                            

                            <select  wire:model.live="filterSexe" @class([
                            'outline-0 text-gray-600 ',
                            'dark:text-ugnh-blueClair dark:border-gray-600'
                            ])>
                                <option class="dark:text-ugnh-blueFonce" value="">Sexe</option>
                                <option class="dark:text-ugnh-blueFonce" value="M">M</option>
                                <option class="dark:text-ugnh-blueFonce" value="F">F</option>
                                {{-- <option class="dark:text-ugnh-blueFonce" value="">...</option> --}}
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
						<p>Code</p>
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
						<p>Telephone</p>
					</th>
					<th class="px-1 py-3">
						<p>Fonction</p>
					</th>

                    <th class="px-1 py-3 w-20 text-center">
						<p>Action</p>
					</th>
				</tr>
			</thead>
			<tbody>
			@if ($this->Personnels->isNotEmpty())
			@foreach ($this->Personnels as $personnel)
				<tr class="border-b border-[#ccc] dark:border-gray-800 dark:hover:bg-gray-600 hover:bg-ugnh-blueClair  transition-all duration-200 ease-in-out ">
					<td class="p-1 text-yellow-500 font-bold">
						<p>{{ $personnel->code }}</p>
					</td>
					<td class="p-1">
						<p> {{ $personnel->nom }}</p>
					</td>
					<td class="p-1">
						<p>{{ $personnel->prenom }}</p>
					</td>
					<td class="p-1">
						<p>{{ $personnel->sexe }}</p>
					</td>
					<td class="p-1">
                        <p>{{ $personnel->telephone }}</p>
					</td>
					<td class="p-1 ">
                        <p>{{ $personnel->fonction }}</p>
					</td>


                    <td class="p-1 flex flex-row justify-center">
                        <svg  wire:click="sessionEdit({{ $personnel->id }})" @click="form = !form, $dispatch('open-modal')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer hover:text-ugnh-blueClair hover:scale-120">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        @php
                            $role = Auth::user()->roles->first()->nom ?? '';
                            $isAdmin = $role == "Administrateur";
                        @endphp

                        @if($isAdmin)
                        <svg wire:click="selectionPersonnel({{ $personnel->id }})" @click="modalConfirmation = !modalConfirmation"   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer text-red-500 hover:text-red-400 hover:scale-120">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        @endif

                    </td>
				</tr>
			
			@endforeach
			@endif

			</tbody>
		</table>
	</div>


    @if ($this->Personnels->isEmpty())
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
							Aucun personnel trouvé.
						@else
							Aucun personnel enregistré. Veuillez ajouter un personnel!
						@endif</p>
					</div>
				</div>
			</div>
        
    @endif
			

    @if ($this->Personnels->isNotEmpty())
        <div class="mt-4 bottom-0 w-full left-0">
            {{ $this->Personnels->links('pagination::tailwind') }}
        </div>
    @endif
   





	 {{-- message de succes --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:success-delete.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 5000);
    "
    x-show="show"
    class="flex w-auto overflow-hidden bg-white dark:bg-gray-700 dark:border dark:border-emerald-600 shadow-2xl rounded-2xl absolute z-50 top-[45%] md:left-[30%] left-[20%] md:right-[30%]  right-[20%] "
    >

    <div class="flex items-center justify-center w-12">
        <svg class="w-6 h-6 text-emerald-500 fill-current" viewBox="0 0 40 40">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
        </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
            <span class="font-semibold text-emerald-500 dark:emerald-red-500">Succes</span>

            <p class="text-sm text-gray-600 dark:text-gray-200" x-text="message"></p>
        </div>
    </div>

    </div>




    {{-- message d'erreur --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:erreur.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 5000);
    "
    x-show="show"
    class="flex w-auto overflow-hidden bg-white dark:bg-gray-700 dark:border dark:border-red-600 shadow-2xl rounded-2xl absolute z-50 top-[45%] md:left-[30%] left-[20%] md:right-[30%]  right-[20%] "
    >

    <div class="flex items-center justify-center w-12">
        <svg class="w-6 h-6 text-red-500 fill-current" viewBox="0 0 40 40">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
        </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
            <span class="font-semibold text-red-500 dark:text-red-500">Erreur</span>

            <p class="text-sm text-gray-600 dark:text-gray-200" x-text="message"></p>
            {{-- <p class="text-sm text-gray-600 dark:text-gray-200">Une erreur est survenue, veuillez reessayer.</p> --}}
        </div>
    </div>

    </div>



    

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
                    <h1 class="font-bold ">Suppression du personnel</h1>
                    <p>Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.</p>

                    <div class=" mt-5 flex fle-col gap-3 sm:justify-end justify-between">
                        <button wire:click="deletePersonnel({{ $personnelSelectionner }})"  @click="modalConfirmation = !modalConfirmation" class="bg-red-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-red-400">Supprimer</button>
                        <button @click="modalConfirmation = !modalConfirmation" class="bg-gray-600 p-2 w-25 rounded-lg text-gray-50 hover:bg-gray-400">Annuler</button>
                    </div>
                </div>
             </div>
        </div>

    </div>
    
</section>




    {{-- <section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
    ])
    x-show="modalPDF"
    x-transition.duration.300ms
    >

    <div @class(['absolute z-50 sm:top-0 top-5 right-0   cursor-pointer border border-red-500 rounded-full p-1 text-red-500 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
    @click="modalPDF = !modalPDF"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>

    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-70 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="bg-white p-5 dark:bg-gray-800 lg:w-[60%]  sm:w-[80%] w-full  h-full  shadow-2xl overflow-y-auto ">
         
            <h2>Rapport Personnels</h2>

            <p>Total : 30</p>

            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Philippe</td>
                        <td>Jamesley</td>
                        <td>Masculin</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    
</section> --}}







</div>