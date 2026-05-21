        <div @class([
            'flex flex-col justify-between  gap-3 w-full',
            'sm:flex-row  '
        ])>
                <div class=" flex flex-row gap-3 w-full sm:w-1/2">
                <div @class([
                    'p-3 rounded  w-1/2 flex flex-row items-center justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700  '
                ])>
                    <div @class(['flex flex-col gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row gap-2 items-center ',
                            'dark:text-gray-300'
                        
                        ])> 
                        <div class="bg-yellow-500 text-ugnh-blueClair p-2 rounded-xl "> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>

                            Total personnel
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-300'
                            ])>
                            {{ $this->TotalPersonnels }}</p>
                    </div>
            
                </div>


                <div @class([
                    'p-3 rounded w-1/2 flex flex-row items-center justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700'
                ])>
                    <div @class(['flex flex-col gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row gap-2 items-center ',
                            'dark:text-gray-300'
                        
                        ])> 
                        <div class="bg-ugnh-blueFonce text-ugnh-blueClair p-2 rounded-xl "> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                             Total Homme
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-300 '
                            ])>
                            {{ $this->TotalPersonnelsHomme }}</p>
                    </div>
            
                </div>
                </div>

                <div @class([
                    'p-3 rounded w-full sm:w-1/2 flex flex-row items-center justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700'
                ])>
                    <div @class(['flex flex-col gap-1'])>
                        <h1 @class([
                            'text-gray-600 flex flex-row gap-2  items-center',
                            'dark:text-gray-300'
                        
                        ])> 
                        <div class="bg-pink-400 text-ugnh-blueClair p-2 rounded-xl "> 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                            Total femme
                        </h1>
                        <p @class([
                            'font-bold text-gray-600 text-xl',
                            'dark:text-gray-300'
                            ])>
                            {{ $this->TotalPersonnelsFemme }}</p>
                    </div>
            
                </div>

    </div>