<section class="p-2 h-full sm:ms-3 bg-white dark:bg-gray-900  dark:border dark:border-gray-700 rounded-s-sm">
        
    <section @class([
        'flex flex-row justify-between items-center'
    ])>
        <div class="flex flex-row gap-2 items-center">
            <button 
            @click="open = !open"
            class="cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="dark:text-gray-300 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                </svg>
            </button>

            <a 
            :class="!inpuRechercherTop ? '' : 'hidden'"
            @class([
            'flex items-center gap-3 md:hidden'
            ])  
            href="#"
            >
                <img class="min-w-9 h-9 ms-1" src="{{ asset('images/logoUGNH.png') }}" alt="">
                <p :class="open ? 'w-0' : ''" class="dark:text-gray-300 font-extrabold hidden sm:block text-gray-600  whitespace-nowrap">UGNH APP</p>
            </a>

            <h1 x-text="active" @class([
                'font-bold text-gray-600 text-[15px] hidden',
                'md:block md:text-[20px]',
                'dark:text-gray-300'
            ])></h1>

            {{-- <p x-text="active"></p> --}}
        </div>

        <div>
            <div @class([
                'flex flex-row gap-5 items-center'
            ])>

                {{-- <div class="flex flex-row items-center relative">
                    <input 
                        :class="!inpuRechercherTop ? 'w-0' : 'w-full'"  
                        class="border border-ugnh-blueClair dark:border-gray-600 rounded p-1 pe-7 shadow-sm outline-0 
                        text-gray-600 dark:text-gray-300 
                        bg-white dark:bg-gray-800 
                        w-0" 
                        type="text" 
                        placeholder="Rechercher"
                    >
                    <svg @click="inpuRechercherTop= !inpuRechercherTop" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2 absolute right-0 text-gray-400 dark:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
               
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 dark:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                </div> --}}

               

                        <!-- CONTENT -->
                        <livewire:pages.notificable />
{{--                             
                    </div>

                </div> --}}

                

                <img @click="modalProfil = !modalProfil" class="object-cover rounded-full h-7 w-7" src="{{ Storage::url("profileUtilisateur/".Auth::user()->photo) }}" alt="avatar" />
                
                <div 
                :class="modalProfil ? 'h-[37%] border-5 border-white dark:border-gray-700 shadow-2xl pb-3' : 'h-0'" 
                class="md:w-[20%] bg-ugnh-blueFonce dark:bg-gray-800 text-white dark:text-gray-200 absolute z-50 right-1 top-10 rounded-lg flex flex-col gap-1 overflow-hidden transition-all duration-200 ease-in-out">

                    <div class="p-2 flex flex-row gap-3 border border-gray-600 dark:border-gray-700 items-center"> 
                        <div>
                             <img class="object-cover rounded-full h-7 w-7" src="{{ Storage::url("profileUtilisateur/".Auth::user()->photo) }}" alt="avatar" />
                        </div>
                        <div>
                            <h1 class="p-2">
                                {{ Auth::user()->personnel->nom.' '.Auth::user()->personnel->prenom }}
                            </h1>
                            <p class="text-sm italic p-2 -mt-5">
                                {{ Auth::user()->nomUtilisateur }}
                            </p>
                            <p class="text-[12px] italic opacity-65 p-2 -mt-5">
                                {{ Auth::user()->roles->first()->nom ?? '' }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('mon-profile') }}">
                        <div class="w-full p-2 flex flex-row gap-1 hover:bg-ugnh-blueHover dark:hover:bg-gray-700">
                            <svg class="w-6 h-6" ...></svg>
                            Mon profil
                        </div>
                    </a>

                    {{-- <div class="w-full p-2 flex flex-row gap-1 hover:bg-ugnh-blueHover dark:hover:bg-gray-700">
                        <svg class="w-6 h-6" ...></svg>
                        Parametre
                    </div> --}}

                    <div wire:click="toggleModeClairOrSombre" class="w-full p-2 flex flex-row gap-1 hover:bg-ugnh-blueHover dark:hover:bg-gray-700">
                        <svg class="w-6 h-6" ...></svg>
                        @if (Auth::user()->theme  == 'false' )
                           Mode sombre 
                        @else
                           Mode clair
                        @endif
                        
                    </div>

                    <a href="{{ route('logout') }}">
                        <div class="w-full p-2 flex flex-row gap-1 hover:bg-ugnh-blueHover dark:hover:bg-gray-700">
                            <svg class="w-6 h-6" ...></svg>
                            Deconnecter
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</section>