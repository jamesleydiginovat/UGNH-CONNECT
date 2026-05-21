
<section @class([
    'w-full h-full overflow-y-hidden bg-transparent fixed z-10 bottom-0 left-0 '
])
x-show="formRolesEtPermission"
x-transition.duration.300ms

>



    <section @class([
        'w-full h-full p-0 sm:p-3 bg-gray-900 opacity-80 overflow-hidden  dark:bg-gray-800 dark:border-gray-600  absolute  bottom-0 left-0  shadow-sm  border-t border-[#ccc] shadow-none dark:sm:shadow-[0_-10px_20px_rgba(255,255,255,0.2)]'
        ])> 
    </section>



    <div class="absolute z-10  w-full m-auto h-full flex flex-row  items-center justify-center">

        <div class="sm:p-5 p-1 bg-white relative dark:bg-gray-800 dark:border-5 border-gray-600 dark:text-gray-200 lg:w-[70%]  sm:w-[80%] w-full sm:h-auto h-full rounded-lg shadow-2xl overflow-y-auto ">
            
            <div @class(['fixed sm:absolute sm:top-0  z-50 sm:top-0 top-1 right-1 sm:right-0 bg-red-500 sm:bg-transparent  cursor-pointer  p-1 sm:text-red-500 text-gray-50 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300'])
             @click="formRolesEtPermission = !formRolesEtPermission"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-100 ease-in-out">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>


            <section>
                <div class="overflow-scroll no-scrollbar sm:h-[90vh] h-full dark:border dark:border-gray-600  ">
                    <table class="min-w-full text-xs ">
                        <thead class="bg-ugnh-blueClair dark:bg-gray-700 ">
                            <tr class="text-left  ">
                                <th class="px-1 py-3">
                                    <p>Roles</p>
                                </th>
                                {{-- <th class="px-1 py-3 ">
                                    <p>Permissions</p>
                                </th> --}}
                                {{-- <th class="px-1 py-3 w-20 text-center">
                                    <p>Action</p>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->Roles as $role )
                                <tr class=" dark:border-gray-600  ">

                                <td class="p-1 py-3 dark:bg-gray-500 dark:text-gray-900 font-extrabold ">
                                    <p>{{ $role->nom }}</p>
                                </td>

                                <tr class=" ">
                                    <td class="p-1 py-3 sm:w-full ">
                                    <p class="text-bold text-center   bg-gray-500 dark:bg-gray-900 p-1 ">Permissions</p>
                                    <p>{{ $role->permissions }}</p>
                                   </td>
                                </tr>

                                <tr class="border-b border-[#ccc]">
                                <td class="p-1 py-3 flex flex-row justify-center bg-ugnh-blueClair dark:bg-gray-800">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg> --}}
                                    <form wire:submit="save({{ $role->id }})" class="flex flex-row">
                                        <select  wire:model="permission_id" name="" id="">
                                            <option class="dark:bg-gray-600 dark:text-gray-200" value="">Ajouter une nouvelle permission</option>
                                            @foreach ($this->Permissions as $Permission)
                                               <option class="dark:bg-gray-600 dark:text-gray-200" value="{{ $Permission->id }}">{{ $Permission->nomPermission}}</option> 
                                            @endforeach
                                        </select>
                                        <button wire:click="saveOrDelete('save')" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-500">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button wire:click="saveOrDelete('delete')" class="cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>

                                        </button>
                                        
                                    </form>
                                </td>
                                </tr>

                                
                            </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>

            </section>
            
        </div>




    {{-- message de succes --}}
    <div
    x-data="{ show: false, message: '' }"

    x-on:success-role.window="
        show = true;
        message = $event.detail.message;
        setTimeout(() => show = false, 5000);
    "
    x-show="show"
    class="flex w-full overflow-hidden bg-white shadow-md absolute top-0 left-0"
    >

    <div class="flex items-center justify-center w-12">
        <svg class="w-6 h-6 text-emerald-500 fill-current" viewBox="0 0 40 40">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
        </svg>
    </div>

    <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
            <span class="font-semibold text-emerald-500">Success</span>

            <p class="text-sm text-gray-600" x-text="message"></p>
        </div>
    </div>

    </div>

    </div>

    
</section>


