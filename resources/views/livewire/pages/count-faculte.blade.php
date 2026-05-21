<div class="p-4 rounded-2xl w-full flex flex-row items-center justify-between bg-ugnh-blueClair shadow-sm hover:shadow-md transition dark:border-gray-600 dark:bg-gray-700">

    <!-- INFOS -->
    <div class="flex flex-col gap-1">

        <h1 class="text-gray-600 flex flex-row items-center gap-2 text-nowrap font-semibold dark:text-gray-300">

            <div class="bg-ugnh-blueFonce text-ugnh-blueClair p-2 rounded-xl">

                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-6 h-6">

                    <path stroke-linecap="round" 
                        stroke-linejoin="round" 
                        d="M3.75 21h16.5M4.5 3h15a.75.75 0 01.75.75v16.5a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75V3.75A.75.75 0 014.5 3z" />
                </svg>

            </div>

            Facultés
        </h1>

        <p class="font-bold text-gray-700 text-2xl dark:text-gray-200">
            {{ $this->nombreFaculte }}
        </p>

    </div>

    <!-- BOUTON AJOUT -->
    <button 
    @click="form = !form"
     class="flex items-center gap-2 bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white px-4 py-2 rounded-xl shadow transition">

        <svg xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke-width="1.5" 
            stroke="currentColor" 
            class="w-5 h-5">

            <path stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        Ajouter
    </button>

</div>