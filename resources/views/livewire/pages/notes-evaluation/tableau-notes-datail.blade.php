<section
    x-data="{
        showEditNoteModal: false,
        selectedNote: null
    }"
    class="relative bg-white dark:bg-gray-900 m-3 h-full"
>

    {{-- CLOSE --}}
    <div class="right-0 top-0">
        <div
            @class(['text-end flex flex-row justify-between cursor-pointer p-1 text-red-500'])
            @click="tableSlideNote = !tableSlideNote"
        >
            <div></div>
            <svg xmlns="http://www.w3.org/2000/svg" class="sm:w-6 w-3 sm:h-6 h-3 hover:bg-red-500 hover:text-gray-300 rounded-sm"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
    </div>

    {{-- HEADER ACTIONS --}}
    <div class="flex flex-col gap-2 p-2 lg:flex-row lg:items-center lg:justify-between">
        @php
            $role = Auth::user()->roles->first()->nom ?? '';

            $isAdmin = $role == "Administrateur";
            $isSecretaireGenerale = $role == "Secrétaire générale";
            $doyenFaculte = $role == "Doyen de faculté";
        @endphp

        <!-- BUTTON -->
        @if (!$isAdmin && !$isSecretaireGenerale && !$doyenFaculte)
            <button
                @click="if (@js($periodeOuverte)) { form = !form } else { window.dispatchEvent(new CustomEvent('error-periode')) }"
                class="w-full lg:w-auto bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white p-2 rounded-lg text-sm transition"
            >
                Ajouter une nouvelle note
            </button>
        @endif

        @if ($isAdmin || $isSecretaireGenerale || $doyenFaculte)
            <button
                @click="form = !form"
                class="w-full lg:w-auto bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white p-2 rounded-lg text-sm transition"
            >
                Ajouter une nouvelle note
            </button>
        @endif
        

        {{-- ALERT --}}
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

        {{-- FILTERS --}}
        <div class="flex flex-col sm:flex-row gap-2">

            {{-- FAC --}}
            <select wire:model.live="faculte" class="p-2 rounded bg-gray-100 dark:bg-gray-700">
                <option value="0022">Faculté</option>
                @foreach ($this->Facultes as $faculte)
                    <option value="{{ $faculte->codeFac }}">{{ $faculte->nom }}</option>
                @endforeach
            </select>

            {{-- NIVEAU --}}
            <select wire:model.live="niveau" class="p-2 rounded bg-gray-100 dark:bg-gray-700">
                <option value="">Niveau</option>
                <option value="1">I</option>
                <option value="2">II</option>
                <option value="3">III</option>
                <option value="4">IV</option>
                <option value="5">V</option>
            </select>

            {{-- SESSION --}}
            <select wire:model.live="session" class="p-2 rounded bg-gray-100 dark:bg-gray-700">
                <option value="1">Session</option>
                <option value="1">I</option>
                <option value="2">II</option>
            </select>

        </div>
    </div>

    {{-- TITLE --}}
    <div class="p-2 text-center bg-ugnh-blueFonce text-white">
        <p>{{ $this->FacultesName->nom }} - Niveau: {{ $this->niveau }} - Session: {{ $this->session }}</p>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto p-2">

        <table class="min-w-full text-xs">

            <thead class="bg-ugnh-blueClair dark:bg-gray-700">
                <tr>
                    <th class="p-2">Matricule</th>

                    @foreach($this->Cours as $cours)
                        <th class="p-2">{{ $cours->nom }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>

                @foreach($this->NoteDetail as $matricule => $notesEtudiant)

                    <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">

                        <td class="p-2 font-bold text-yellow-500">
                            {{ $matricule }}
                        </td>

                        @foreach($this->Cours as $cours)

                            @php
                                $note = $notesEtudiant
                                    ->where('codeCours', $cours->codeCours)
                                    ->first();
                            @endphp

                            <td
                                class="p-2 cursor-pointer border-r"
                                wire:click="putNOte({{ $note->noteIntra ?? 'null' }}, {{ $note->examenFinal ?? 'null' }}, {{ $note->noteRattrapage ?? 'null' }}, '{{ $cours->codeCours}}', '{{ $matricule}}', '{{ $this->FacultesName->codeFac }}','{{ $this->niveau }}', '{{ $this->session }}')"
                                @click="
                                    showEditNoteModal = true;
                                    selectedNote = {
                                        matricule: '{{ $matricule }}',
                                        codeCours: '{{ $cours->codeCours }}',
                                        cours: '{{ $cours->nom }}',
                                        noteIntra: {{ $note->noteIntra ?? 'null' }},
                                        examenFinal: {{ $note->examenFinal ?? 'null' }},
                                        rattrapage: {{ $note->noteRattrapage ?? 'null' }},
                                        faculte: '{{ $this->FacultesName->nom }}',
                                        niveau: '{{ $this->niveau }}',
                                        session: '{{ $this->session }}'
                                    }
                                "
                            >

                                @if($note)
                                    @php
                                        $total = ($note->noteIntra ?? 0) + ($note->examenFinal ?? 0);
                                    @endphp

                                    <span class="{{ $total < 65 ? 'text-red-500' : 'text-green-500' }}">
                                        {{ $total }}
                                    </span>
                                    @if ($total < 65 )
                                       <div class="text-xs">
                                            Reprise:
                                            <span class="{{ $total < 65 ? 'text-red-500' : 'text-green-500' }}">
                                                {{ $note->noteRattrapage ?? 'Oui' }}
                                            </span>
                                        </div> 
                                    @else
                                        <div class="text-xs">
                                            Reprise:
                                            <span class="{{ $total < 65 ? 'text-red-500' : 'text-green-500' }}">
                                                {{ $note->noteRattrapage ?? 'Non' }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                @endif

                            </td>

                        @endforeach

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

   {{-- ================= MODAL ================= --}}
    <div
        x-show="showEditNoteModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
    >

        <div
            @click.away="showEditNoteModal = false"
            class="bg-white dark:bg-gray-800 w-full max-w-2xl p-6 rounded-2xl shadow-xl"
        >

            {{-- HEADER --}}
            <div class="flex justify-between mb-4">

                @if ($this->isNoteExiste())
                     <h2 class="font-bold text-lg">Modifier la note</h2>
                @else
                     <h2 class="font-bold text-lg">Ajouter la note</h2>
                @endif
               
                <button @click="showEditNoteModal = false">✕</button>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if(session()->has('successM'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                    class="m-4 p-4 rounded-lg bg-green-100 text-green-700"
                >
                    {{ session('successM') }}
                </div>
            @endif

            {{-- INFOS LECTURE SEULE --}}
            <div class="grid grid-cols-2 gap-2 bg-gray-100 dark:bg-gray-700 p-3 rounded mb-4 text-sm">

                <p><b>Matricule:</b> <span x-text="selectedNote?.matricule"></span></p>
                <p><b>Cours:</b> <span x-text="selectedNote?.cours"></span></p>
                <p><b>Faculté:</b> <span x-text="selectedNote?.faculte"></span></p>
                <p><b>Niveau:</b> <span x-text="selectedNote?.niveau"></span></p>
                <p><b>Session:</b> <span x-text="selectedNote?.session"></span></p>

            </div>

            {{-- FORM --}}
            <form wire:submit.prevent="updateNote" class="space-y-4">

                {{-- MATRICULE (hidden) --}}
                <input type="hidden" wire:model="matricule">
                <input type="hidden" wire:model="codeCours">

                {{-- ================= INTRA ================= --}}
                {{-- @if ($this->noteRattrapage ==null) --}}
                <div>
                    <label class="text-sm font-semibold">Note Intra</label>

                    <input
                        @if ($this->noteRattrapage !=null)
                           @disabled(true) 
                        @endif
                        type="number"
                        step="0.01"
                        wire:model="noteIntra"
                        class="w-full p-2 border rounded dark:bg-gray-700
                        @error('noteIntra') border-red-500 @enderror"
                    >

                    @error('noteIntra')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ================= EXAMEN ================= --}}
                <div>
                    <label class="text-sm font-semibold">Examen final</label>

                    <input
                        @if ($this->noteRattrapage !=null)
                           @disabled(true) 
                        @endif
                        type="number"
                        step="0.01"
                        wire:model="examenFinal"
                        class="w-full p-2 border rounded dark:bg-gray-700
                        @error('examenFinal') border-red-500 @enderror"
                    >

                    @error('examenFinal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- @endif --}}

                {{-- ================= RATTRAPAGE ================= --}}
                @if (($this->noteIntra !=null && $this->examenFinal !=null) && ($this->noteIntra + $this->examenFinal < 65))
                    <div>
                        <label class="text-sm font-semibold">Rattrapage</label>

                        <input
                            type="number"
                            step="0.01"
                            wire:model="noteRattrapage"
                            class="w-full p-2 border rounded dark:bg-gray-700
                            @error('noteRattrapage') border-red-500 @enderror"
                        >

                        @error('noteRattrapage')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>  
                @endif
                

                {{-- ACTIONS --}}
                <div class="flex justify-end gap-3">

                    <button
                        type="button"
                        @click="showEditNoteModal = false"
                        class="px-4 py-2 bg-gray-400 text-white rounded"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded"
                    >
                        Modifier
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>