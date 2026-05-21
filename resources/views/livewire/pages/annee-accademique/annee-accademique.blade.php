<div class="mx-2 sm:mx-3 text-gray-700 dark:text-gray-200">

    {{-- CONTAINER --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-4 sm:p-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-ugnh-blueClair to-white dark:from-gray-800 dark:to-gray-900">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-700 dark:text-white">
                    Tableau de bord académique
                </h1>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Gestion des années académiques et événements
                </p>
            </div>

            <div class="flex flex-wrap gap-3">

                <div class="bg-white dark:bg-gray-800 px-4 py-3 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 min-w-[140px]">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Années académiques
                    </p>

                    <h2 class="text-2xl font-bold text-ugnh-blueFonce dark:text-ugnh-blueClair">
                        {{ $this->AnneeAcademique->count() }}
                    </h2>
                </div>

                <div class="bg-white dark:bg-gray-800 px-4 py-3 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 min-w-[140px]">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Événements
                    </p>

                    <h2 class="text-2xl font-bold text-green-600">
                        {{ $this->Evenement->count() }}
                    </h2>
                </div>

            </div>

        </div>

        {{-- SECTION ANNEE ACADEMIQUE --}}
        <section class="p-3 sm:p-5">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-700 dark:text-white">
                        Années académiques
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Liste des années académiques disponibles
                    </p>
                </div>

            </div>

            @if ($this->AnneeAcademique->isEmpty())

                <div class="flex flex-col items-center justify-center py-16">

                    <div class="bg-yellow-100 dark:bg-yellow-900/30 p-4 rounded-full mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-yellow-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 9v3.75m9.303 3.376c.866 1.5-.217 3.374-1.948 3.374H4.645c-1.73 0-2.813-1.874-1.948-3.374L9.051 3.378c.866-1.5 3.032-1.5 3.898 0l6.354 11.748z" />

                        </svg>

                    </div>

                    <p class="font-semibold text-gray-600 dark:text-gray-300">
                        Aucune année académique disponible
                    </p>

                </div>

            @else

                <div class="overflow-x-auto rounded-2xl border border-gray-200 dark:border-gray-700">

                    <table class="w-full min-w-[700px]">

                        <thead class="bg-gray-100 dark:bg-gray-800">

                            <tr class="text-left text-xs uppercase tracking-wider text-gray-600 dark:text-gray-300">

                                <th class="px-4 py-4">Libellé</th>

                                <th class="px-4 py-4">Date début</th>

                                <th class="px-4 py-4">Date fin</th>

                                <th class="px-4 py-4 text-center">Statut</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach ($this->AnneeAcademique as $annee)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200">

                                    <td class="px-4 py-4">

                                        <div class="font-semibold text-gray-700 dark:text-white">
                                            {{ $annee->libelle }}
                                        </div>

                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($annee->date_debut)->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($annee->date_fin)->format('d M Y') }}
                                    </td>

                                    <td class="px-4 py-4 text-center">

                                        @if ($annee->active)

                                            <span class="bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 px-3 py-1 rounded-full text-xs font-semibold">
                                                Active
                                            </span>

                                        @else

                                            <span class="bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 px-3 py-1 rounded-full text-xs font-semibold">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                @if ($this->AnneeAcademique->isNotEmpty())

                    <div class="mt-5">
                        {{ $this->AnneeAcademique->links('pagination::tailwind') }}
                    </div>

                @endif

            @endif

        </section>

        {{-- EVENEMENTS --}}
        <section class="p-3 sm:p-5 border-t border-gray-200 dark:border-gray-700">

            <div class="mb-5">

                <h2 class="text-lg sm:text-xl font-bold text-gray-700 dark:text-white">
                    Événements académiques
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Gestion et modification des événements
                </p>

            </div>

            @if ($this->Evenement->isEmpty())

                <div class="flex flex-col items-center justify-center py-16">

                    <div class="bg-red-100 dark:bg-red-900/30 p-4 rounded-full mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-red-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 8v4m0 4h.01M4.93 19h14.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.2 16c-.77 1.33.19 3 1.73 3z" />

                        </svg>

                    </div>

                    <p class="font-semibold text-gray-600 dark:text-gray-300">
                        Aucun événement disponible
                    </p>

                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($this->Evenement as $event)

                        @php
                            $now = now();
                            $debut = \Carbon\Carbon::parse($event->date_debut);
                            $fin = \Carbon\Carbon::parse($event->date_fin);

                            if ($now->between($debut, $fin)) {
                                $status = 'En cours';
                                $color = 'bg-green-500';
                            } elseif ($now->lt($debut)) {
                                $status = 'À venir';
                                $color = 'bg-yellow-500';
                            } else {
                                $status = 'Expiré';
                                $color = 'bg-red-500';
                            }
                        @endphp

                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">

                            {{-- HEADER --}}
                            <div class="p-5 border-b border-gray-100 dark:border-gray-700">

                                <div class="flex justify-between items-start gap-3">

                                    <div>

                                        <h2 class="font-bold text-lg text-gray-700 dark:text-white">
                                            {{ $event->nom }}
                                        </h2>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">
                                            {{ $event->description }}
                                        </p>

                                    </div>

                                    <span class="{{ $color }} text-white text-xs px-3 py-1 rounded-full whitespace-nowrap">
                                        {{ $status }}
                                    </span>

                                </div>

                            </div>

                            {{-- BODY --}}
                            <div class="p-5 space-y-4">

                                <div>

                                    <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                                        Date début
                                    </label>

                                    @if($editEventId === $event->id)

                                        <input type="date"
                                            wire:model="editDateDebut"
                                            class="mt-1 w-full p-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 outline-none">

                                    @else

                                        <p class="mt-1 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            📅 {{ $debut->format('d M Y') }}
                                        </p>

                                    @endif

                                </div>

                                <div>

                                    <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                                        Date fin
                                    </label>

                                    @if($editEventId === $event->id)

                                        <input type="date"
                                            wire:model="editDateFin"
                                            class="mt-1 w-full p-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 outline-none">

                                    @else

                                        <p class="mt-1 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            📅 {{ $fin->format('d M Y') }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                            {{-- FOOTER --}}
                            <div class="p-5 pt-0">

                                @if($editEventId === $event->id)

                                    <div class="flex flex-col sm:flex-row gap-3">

                                        <button
                                            wire:click="updateEvent({{ $event->id }})"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-xl transition">

                                            Sauvegarder

                                        </button>

                                        <button
                                            wire:click="$set('editEventId', null)"
                                            class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2.5 rounded-xl transition">

                                            Annuler

                                        </button>

                                    </div>

                                @else

                                    <button
                                        wire:click="startEdit({{ $event->id }}, '{{ $event->date_debut }}', '{{ $event->date_fin }}')"
                                        class="w-full bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white py-2.5 rounded-xl transition">

                                        Modifier l'événement

                                    </button>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </section>

    </div>

</div>