<section class="relative bg-white dark:bg-gray-900  m-3 h-full">
    <div class=" right-0 top-0 ">
        <div @class(['text-end  flex flex-row justify-between cursor-pointer p-1 text-red-500 '])
            @click="tableSlideNote = !tableSlideNote"
            >
                <div></div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="sm:w-6 w-3 sm:h-6 h-3 transition-all duration-500 ease-in-out hover:bg-red-500 hover:text-gray-300 rounded-sm">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
        </div>
    </div>

    <div class="flex flex-col gap-2 p-2 lg:flex-row lg:items-center lg:justify-between">

        <!-- Bouton -->
        <button 
            {{-- @click="form = !form"  --}}
            @click="
                                if (@js($periodeOuverte)) {
                                    form = !form
                                } else {
                                    window.dispatchEvent(new CustomEvent('error-periode'))
                                }
                            "

            class="w-full lg:w-auto hover:shadow-sm hover:bg-ugnh-blueHover bg-ugnh-blueFonce hover:text-gray-50 transition-all duration-300 border border-ugnh-blueFonce p-2 rounded-lg text-gray-50 text-sm">
            Ajouter une nouvelle note
        </button>



        <div
            x-data="{ show:false }"
            x-on:error-periode.window="
                show = true;
                setTimeout(() => show = false, 3000)
            "
            x-show="show"
            x-transition
            class="fixed top-15 left-50 bg-red-600 text-white px-4 py-2 rounded shadow-lg z-50"
        >
            ❌ La période de saisie des notes est fermée
        </div>

        <!-- Filtres -->
        <div class="flex flex-col sm:flex-row flex-wrap gap-2 w-full lg:w-auto">

            <!-- Faculté -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                    </svg>
                </div>

                <select wire:model.live="faculte"
                    class="w-full bg-transparent outline-0 text-gray-600 dark:text-ugnh-blueClair">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="0022">Faculte</option>
                    @foreach ($this->Facultes as $faculte)
                        <option class="dark:text-gray-200 dark:bg-gray-600" value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Niveau -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                    </svg>
                </div>

                <select wire:model.live="niveau"
                    class="w-full bg-transparent outline-0 text-gray-600 dark:text-ugnh-blueClair">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">Niveau</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="3">III</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600"  value="4">IV</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="5">V</option>
                </select>
            </div>

            <!-- Session -->
            <div class="flex items-center gap-1 bg-blue-50 dark:bg-gray-600 shadow-sm rounded p-1 w-full sm:w-auto">
                <div class="bg-ugnh-blueFonce p-1 rounded shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                    </svg>
                </div>

                <select wire:model.live="session"
                    class="w-full bg-transparent outline-0 text-gray-600 dark:text-ugnh-blueClair">
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="">Session</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="1">I</option>
                    <option class="dark:text-gray-200 dark:bg-gray-600" value="2">II</option>
                </select>
            </div>

        </div>

    </div>

    @php
        $this->NoteDetail;
    @endphp
     

    <div class="p-2 dark:text-gray-200">
            <div class="overflow-x-auto  ">
                <div class=" p-2 text-center bg-ugnh-blueFonce text-ugnh-blueClair">
                    <p>{{ $this->FacultesName->nom }} - Niveau: {{  $this->niveau }} - Session: {{ $this->session }}</p>
                </div>
                <table class="min-w-full text-xs ">
                    <thead class="bg-ugnh-blueClair dark:bg-gray-700 ">
                        
                        {{-- <tr class="text-left  bg-ugnh-blueFonce text-ugnh-blueClair">
                            <th class="px-1 py-3">
                                <p>{{ $this->FacultesName->nom }} - Niveau: {{  $this->niveau }} - Session: {{ $this->session }}</p>
                            </th>
                        </tr> --}}
                        
                        <tr class="text-left  ">
                            <th class="px-1 py-3">
                                <p>Matricule</p>
                            </th>

                            @foreach($this->Cours as $cours)
                                <th class="px-1 py-3">
                                   <p>{{ $cours->nom}}</p>
                                </th>
                            @endforeach
                           
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($this->NoteDetail as $matricule => $notesEtudiant)
                            <tr class="border-b mb-2 border-ugnh-blueFonce dark:border-gray-600 hover:bg-ugnh-blueClair dark:hover:bg-gray-600 hover:shadow-sm">

                                <td class="p-1 border-r border-gray-300 font-bold dark:text-yellow-500">
                                    <p>{{ $matricule}}</p>
                                </td>

                                @foreach($this->Cours as $cours)
                                    <td class="p-1 border-r border-gray-300 font-bold">
                                        @php
                                        $note = $notesEtudiant
                                            ->where('codeCours', $cours->codeCours)
                                            ->first();
                                        @endphp
                                        
                                            @if($note && ($note->noteIntra !== null || $note->examenFinal !== null))
                                                    @if ((($note->noteIntra ?? 0) + ($note->examenFinal ?? 0)) < 65 )
                                                        <p class="text-red-500">
                                                        {{ ($note->noteIntra ?? 0) + ($note->examenFinal ?? 0) }}
                                                        </p>
                                                    @else
                                                        <p class="text-green-500">
                                                        {{ ($note->noteIntra ?? 0) + ($note->examenFinal ?? 0) }}
                                                        </p>
                                                    @endif
                                                    
                                            @endif
                                        

                                        @if($note && ($note->noteIntra !== null && $note->examenFinal !== null))
                                            @if ((($note->noteIntra ?? 0) + ($note->examenFinal ?? 0)) < 65 )
                                                <p class=" font-normal text-red-500">
                                                    Reprise: {{$note->noteRattrapage ?? "Oui"}}
                                                </p>
                                            @else
                                                 <p class=" font-normal text-green-500">
                                                    Reprise: Non
                                                </p>
                                            @endif
                                            
                                        @endif
                                    </td>
                                    
                                @endforeach
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

    </div>
     
    <livewire:pages.notes-evaluation.formulaire-notes-evaluation />

</section>

