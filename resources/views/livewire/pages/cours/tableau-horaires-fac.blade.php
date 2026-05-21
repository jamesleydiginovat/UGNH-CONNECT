<section class="relative bg-white dark:bg-gray-900 m-3 h-full">
    <div class=" right-0 top-0 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 mx-3'])
            
            >
                <svg x-show="pdf"  @click="pdf = !pdf" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-ugnh-blueFonce hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                <div x-show="!pdf" ></div>


                <svg @click="tableSlide = !tableSlide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg> 
        </div>
    </div>


    <div
     x-show="!pdf"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">

    <div class="flex flex-col sm:flex-row p-2 justify-between gap-2">

        <div class="flex flex-row gap-2">
            <!-- BUTTON -->
            <button 
                {{-- @click="formHoraire = !formHoraire" --}}
                wire:click="export"
                class="w-full sm:w-auto hover:shadow-sm hover:bg-ugnh-blueHover bg-ugnh-blueFonce hover:text-gray-50 transition-all duration-300 border border-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">
                Generer PDF
            </button>

            @php
                $role = Auth::user()->roles->first()->nom ?? '';

                // ❌ rôles bloqués
                $isBlocked = in_array($role, ['Secrétaire faculté', 'Vice doyen faculté']);
            @endphp

            <button
                @click="{{ !$isBlocked ? 'formHoraire = !formHoraire' : 'null' }}"
                class="w-full sm:w-auto transition-all duration-300 p-2 rounded-lg text-sm border
                    {{ !$isBlocked
                        ? 'hover:shadow-sm hover:bg-ugnh-blueHover bg-ugnh-blueFonce hover:text-gray-50 text-gray-50 border-ugnh-blueFonce'
                        : 'opacity-60 cursor-not-allowed bg-gray-400 text-gray-200 border-gray-400' }}"
            >
                Création d'horaire

                {{-- 🔒 CADENAS --}}
                @if($isBlocked)
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-4 h-4 inline ml-1 text-gray-300">
                        <path fill-rule="evenodd"
                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
            </button>

        </div>
        

        <!-- FILTERS -->
        <div class="flex flex-col sm:flex-row flex-wrap gap-2 w-full sm:w-auto">

            <!-- FACULTE -->
            <div @class([
                'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto flex-1 min-w-0'
            ])>
                <div @class(['bg-ugnh-blueFonce p-1 rounded shrink-0'])>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byFaculte" @class([
                    'outline-0 text-gray-600 bg-transparent w-full min-w-0',
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                ])>
                    <option class="dark:text-ugnh-blueFonce" value="">Faculte</option>
                    @foreach ($this->Facultes as $faculte)
                        <option class="dark:text-gray-200 dark:bg-gray-700"
                            value="{{ $faculte->codeFac }}">
                            {{ $faculte->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- NIVEAU -->
            <div @class([
                'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto flex-1 min-w-0'
            ])>
                <div @class(['bg-ugnh-blueFonce p-1 rounded shrink-0'])>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="byNiveau" @class([
                    'outline-0 text-gray-600 bg-transparent w-full min-w-0',
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                ])>
                    <option class="dark:text-ugnh-blueFonce" value="">Niveau</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="1">I</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="2">II</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="3">III</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="4">IV</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="5">V</option>
                </select>
            </div>

            <!-- SESSION -->
            <div @class([
                'flex flex-row items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto flex-1 min-w-0'
            ])>
                <div @class(['bg-ugnh-blueFonce p-1 rounded shrink-0'])>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <select wire:model.live="bySession" @class([
                    'outline-0 text-gray-600 bg-transparent w-full min-w-0',
                    'dark:text-ugnh-blueClair dark:border-gray-600'
                ])>
                    <option class="dark:text-ugnh-blueFonce" value="">Session</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="1">I</option>
                    <option class="dark:text-gray-200 dark:bg-gray-700" value="2">II</option>
                </select>
            </div>

        </div>

    </div>
     

    <div class="p-2 dark:text-gray-200">
            <div class="overflow-x-auto  ">
                <table class="min-w-full text-xs ">
                    <thead class="bg-ugnh-blueClair dark:bg-gray-700 ">
                        <tr class="text-left  ">
                            <th class="px-1 py-3">
                                <p>Faculte</p>
                            </th>
                            <th class="px-1 py-3">
                                <p>Lundi</p>
                            </th>
                            <th class="px-1 py-3">
                                <p>Mardi</p>
                            </th>
                            <th class="px-1 py-3">
                                <p>Mercredi</p>
                            </th>
                            <th class="px-1 py-3 ">
                                <p>Jeudi</p>
                            </th>
                            <th class="px-1 py-3">
                                <p>Vendredi</p>
                            </th>

                            <th class="px-1 py-3 ">
                                <p>Samedi</p>
                            </th>

                            <th class="px-1 py-3">
                                <p>Dimanche</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $this->Horaires;
                        @endphp --}}
                        @foreach($this->Horaires as $faculteCode => $faculte)
                        @foreach($faculte as $niveau => $niveaux)
                        @foreach($niveaux as $session => $sessions)
                         @php
                            $coursSample = collect($sessions)->flatten()->first();
                            $profSample =collect($sessions)->flatten()->first();
                        @endphp
                            <tr class="border-b mb-2 border-ugnh-blueFonce dark:border-gray-600 dark:hover:bg-gray-600 hover:bg-ugnh-blueClair hover:shadow-sm">

                                <td class="p-1 border-r border-gray-300 dark:border-gray-700 font-bold">
                                    {{-- <p>{{ $cours->codeCours}}</p> --}}
                                    <p>{{ $coursSample->faculte->nom ?? '---'}} ({{ $niveau }})</p>
                                </td>



                                @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $jour)
                                <td class="p-1 align-top border-r border-gray-300 dark:border-gray-700">
                                    @if(isset($sessions[$jour]))
                                        @foreach(collect($sessions[$jour])->sortBy('heure_debut') as $cours)
                                            <div class="border-b border-gray-300 dark:border-gray-700">
                                                <p>
                                                    {{ $cours->cours }} 
                                                    ({{ substr($cours->heure_debut, 0, 5) }} - {{ substr($cours->heure_fin, 0, 5) }} hr)
                                                </p>

                                                <p class="text-ugnh-blueHover dark:hover:text-yellow-500">
                                                    {{ $this->nomProf($cours->prof->codeProf ?? '---') }}
                                                </p>
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                                @endforeach
                                </tr>
                        @endforeach
                        @endforeach
                        @endforeach

                    </tbody>
                </table>
            </div>

    </div>
    </div>
    <livewire:pages.cours.formulaire-horaire-fac />



    <div 
    class="h-full"
     x-on:success-pdffiche.window="pdf = !pdf"
     x-show="pdf"
     x-cloak
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     {{-- x-transition:leave="transition ease-in duration-500" --}}
     x-transition:leave-start="opacity-100 transform translate-y-0"
     x-transition:leave-end="opacity-0 transform translate-y-4">
     
     <section class="mx-3 h-screen">
        {{-- @include('livewire.pages.pdf.iframes.pdf-personnel') --}}
        <livewire:pages.pdf.iframes.pdf-horaire />
    </section>
    
    </div>

</section>

