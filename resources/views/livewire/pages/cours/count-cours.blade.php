 <div @class([
            'flex flex-col justify-between gap-3 w-full',
            'sm:flex-row  '
        ])>
            <div class="flex flex-col lg:flex-row gap-3 w-full">

                <!-- BOX 1 -->
                <div @class([
                    'p-3 rounded gap-4 w-full lg:w-1/2 flex flex-col sm:flex-row items-start sm:items-center justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700'
                ])>

                    <div class="flex flex-col gap-1 w-full">
                        <p class="text-sm text-gray-600 dark:text-gray-200">
                            Cette section permet de gérer les cours. Vous pouvez également créer des horaires de cours et consulter les horaires déjà enregistrés.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-2">
                            <button @click="tableSlide = !tableSlide"
                                class="w-full sm:w-auto hover:shadow-sm hover:bg-ugnh-blueHover hover:text-gray-50 transition-all duration-300 bg-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">
                                Voir les horaire des cours
                            </button>

                            @php
                                $role = Auth::user()->roles->first()->nom ?? '';

                                // ❌ rôles bloqués
                                $isBlocked = in_array($role, ['Secrétaire faculté']);
                            @endphp

                            <button
                                @click="{{ !$isBlocked ? 'tableSlide = !tableSlide; setTimeout(() => {formHoraire = !formHoraire;}, 1000)' : 'null' }}"
                                class="w-full sm:w-auto transition-all duration-300 p-2 rounded-lg text-sm border
                                    {{ !$isBlocked
                                        ? 'hover:shadow-sm hover:bg-ugnh-blueHover hover:text-gray-50 text-ugnh-blueFonce dark:text-gray-200 border-ugnh-blueFonce'
                                        : 'opacity-60 cursor-not-allowed text-gray-500 border-gray-400' }}"
                            >
                                Créer horaire

                                {{-- 🔒 CADENAS --}}
                                @if($isBlocked)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="w-4 h-4 inline ml-1 text-gray-500">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </button>
                        </div>
                    </div>

                </div>


                <!-- BOX 2 -->
                <div @class([
                    'p-3 rounded gap-4 w-full lg:w-1/2 flex flex-col justify-between bg-ugnh-blueClair',
                    'dark:border-gray-600 dark:bg-gray-700'
                ])>

                    <div class="flex flex-col sm:flex-row justify-between gap-3 w-full">

                        <!-- LEFT -->
                        <div @class(['flex flex-col gap-1 w-full sm:w-auto'])>
                            <h1 @class([
                                'text-gray-600 flex flex-row items-center gap-2 text-nowrap',
                                'dark:text-gray-300'
                            ])>
                                <div class="bg-ugnh-blueFonce text-ugnh-blueClair p-2 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                </div>
                                Total cours
                            </h1>

                            <p @class([
                                'font-bold text-gray-600 text-xl',
                                'dark:text-gray-300'
                            ])>
                                {{ $this->CountCours }}
                            </p>
                        </div>


                        <!-- FILTER -->
                        <div @class([
                            'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 h-10 rounded p-1 w-full sm:w-auto max-w-full overflow-hidden'
                        ])>

                            <div @class(['bg-ugnh-blueFonce p-1 rounded shrink-0'])>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>

                            <select wire:model.live="byFaculte"
                                @class([
                                    'outline-0 text-gray-600 bg-transparent w-full min-w-0',
                                    'dark:text-ugnh-blueClair dark:border-gray-600'
                                ])>

                                <option class="dark:text-ugnh-blueFonce" value="">Tous</option>

                                @foreach ($this->Facultes as $faculte)
                                    <option class="dark:text-gray-200 dark:bg-gray-700"
                                        value="{{ $faculte->codeFac }}">
                                        {{ $faculte->nom }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-200">
                        Consultez en temps réel le nombre total de cours à l’UNGH et filtrez les résultats par faculté.
                    </p>

                </div>

            </div>


                

                

    </div>