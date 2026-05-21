<section>
    <div>
        <h1 class="text-2xl font-bold flex items-center gap-2 dark:text-gray-500 mb-5">Liste de vos cours</h1>
    </div>
    @foreach($this->coursBySession() as $session => $coursList)

    <div class="mb-10">

    <!-- TITRE SESSION -->
    <div class="flex items-center justify-between mb-4">

        <h2 class="text-2xl font-bold flex items-center gap-2
            {{ $session == 1 ? 'text-green-500 dark:text-green-400' : 'text-blue-500 dark:text-blue-400' }}">

            <span class="w-3 h-3 rounded-full
                {{ $session == 1 ? 'bg-green-500' : 'bg-blue-500' }}">
            </span>

            Session {{ $session }}
        </h2>

        <span class="text-xs px-3 py-1 rounded-full
            bg-gray-100 text-gray-600
            dark:bg-gray-800 dark:text-gray-300">
            {{ count($coursList) }} cours
        </span>

    </div>

    <!-- LISTE DES COURS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        @forelse($coursList as $cours)

            <div class="group p-4 rounded-xl border
                        bg-white dark:bg-gray-900
                        border-gray-200 dark:border-gray-700
                        shadow-sm
                        hover:shadow-lg hover:-translate-y-1 transition duration-300">

                <!-- HEADER CARD -->
                <div class="flex items-start justify-between">

                    <h3 class="font-semibold
                        text-gray-800 dark:text-gray-100
                        group-hover:text-indigo-600 dark:group-hover:text-indigo-400
                        transition">
                        {{ $cours->titre }}
                    </h3>

                    <span class="text-xs px-2 py-1 rounded
                        bg-indigo-50 text-indigo-600
                        dark:bg-indigo-900/40 dark:text-indigo-300">
                        Cours
                    </span>

                </div>

                <!-- CODE -->


                <p class="text-sm mt-2
                    text-gray-500 dark:text-gray-400">
                    Code :
                    <span class="font-medium
                        text-gray-700 dark:text-gray-200">
                        {{ $cours->codeCours }}
                    </span>
                </p>

                <p class="text-sm mt-2
                    text-gray-500 dark:text-gray-400">
                    Nom :
                    <span class="font-medium
                        text-gray-700 dark:text-gray-200">
                        {{ $cours->nom }}
                    </span>
                </p>

                <!-- FOOTER -->
                <div class="mt-4 flex items-center justify-between">

                    <span class="text-xs
                        text-gray-400 dark:text-gray-500">
                        Session {{ $session }}
                    </span>

                    <button class="text-xs px-3 py-1 rounded-lg
                        bg-gray-100 hover:bg-gray-200
                        dark:bg-gray-800 dark:hover:bg-gray-700
                        text-gray-700 dark:text-gray-300
                        transition">
                        Voir détails
                    </button>

                </div>

            </div>

        @empty

            <div class="col-span-full text-center p-6 rounded-lg
                        bg-gray-50 dark:bg-gray-900
                        border border-gray-200 dark:border-gray-700">

                <p class="text-gray-500 dark:text-gray-400">
                    Aucun cours pour la session {{ $session }}
                </p>

            </div>

        @endforelse

    </div>

</div>

    @endforeach

    <div class="flex flex-row justify-between items-center">
        <div>

        </div>

        <div>
            <label class="text-gray-700 dark:text-gray-200">Cours</label>

            <select wire:model.live="bySession"
                class="w-full mt-2 px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-300">

                <option value="1">Choisir une session</option>
                    <option value="1">Session 1</option>
                    <option value="2">Session 2</option>
            </select>

            @error('cours')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
<div class="overflow-x-auto">

    <h2 class="text-2xl font-bold flex items-center gap-2 dark:text-gray-400 mb-5">
        Horaire session {{ $this->bySession }}
    </h2>

    @if($this->horaires->isEmpty())

        <!-- EMPTY STATE -->
        <div class="flex flex-col items-center justify-center p-10
                    border rounded-xl
                    bg-gray-50 dark:bg-gray-900
                    border-gray-200 dark:border-gray-700">

            <div class="text-5xl mb-3">📅</div>

            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-1">
                Horaire non disponible pour le moment
            </h3>

            <p class="text-sm text-gray-500 dark:text-gray-400 text-center max-w-md">
                L’emploi du temps de cette session n’a pas encore été publié.
                Veuillez revenir plus tard ou contacter l’administration pour plus d’informations.
            </p>

        </div>

    @else

        <!-- TABLE -->
        <table class="min-w-full border text-sm border-gray-200 dark:border-gray-700">

            <!-- HEADER -->
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="border p-3">Horaire</th>
                    <th class="border p-3">Lundi</th>
                    <th class="border p-3">Mardi</th>
                    <th class="border p-3">Mercredi</th>
                    <th class="border p-3">Jeudi</th>
                    <th class="border p-3">Vendredi</th>
                    <th class="border p-3">Samedi</th>
                </tr>
            </thead>

            <tbody class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100">

                @foreach($this->horaires as $horaire => $coursList)
                <tr>

                    <!-- ⏰ Horaire -->
                    <td class="border p-3 font-bold text-gray-900 dark:text-white">
                        {{ $horaire }}
                    </td>

                    @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'] as $jour)

                        @php
                            $cours = $coursList->firstWhere('jour', $jour);
                        @endphp

                        <td class="border p-3 text-gray-800 dark:text-gray-100">

                            @if($cours)
                                <div class="font-semibold text-blue-600 dark:text-blue-400">
                                    {{ $cours->cours }}
                                </div>

                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                    Professeur: {{ $this->nomProf($cours->prof->codeProf ?? '---') }}
                                </div>
                            @else
                                <span class="text-xs text-gray-400 italic">
                                    —
                                </span>
                            @endif

                        </td>

                    @endforeach

                </tr>
                @endforeach

            </tbody>
        </table>

    @endif

</div>






    

</section>
