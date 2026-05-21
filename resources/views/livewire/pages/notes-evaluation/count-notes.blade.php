<div @class([
    'w-full grid grid-cols-1 xl:grid-cols-3 gap-4 items-stretch'
])>

    <!-- SECTION INFORMATION -->
    <div @class([
        'xl:col-span-2 bg-ugnh-blueClair dark:bg-gray-700 rounded-2xl p-3 flex flex-col justify-between shadow-sm'
    ])>

        <!-- TITRE -->
        <div class="">
            <h1 class="text-2xl font-bold text-ugnh-blueFonce dark:text-white mb-2">
                Gestion des Notes
            </h1>

            <p class="text-sm leading-relaxed text-gray-700 dark:text-gray-300">
                Cette section permet de gérer les notes des étudiants.
                Vous pouvez ajouter, modifier et consulter les notes déjà enregistrées
                pour chaque faculté et niveau académique.
            </p>
        </div>

        <!-- ACTIONS -->
        <div class="flex flex-col sm:flex-row gap-3">

            <button
                @click="tableSlideNote = !tableSlideNote"
                class="flex items-center justify-center gap-2 bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white px-3 py-3 rounded-xl transition-all duration-300 shadow hover:shadow-lg w-full sm:w-auto"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 3v18m0-18h16.5M3.75 9h16.5m-16.5 6h16.5m-16.5 6h16.5" />
                </svg>

                Voir les tableaux des notes
            </button>

            <button
                @click="formHoraire = !formHoraire"
                class="flex items-center justify-center gap-2 border border-ugnh-blueFonce text-ugnh-blueFonce dark:text-gray-200 hover:bg-ugnh-blueFonce hover:text-white px-3 py-3 rounded-xl transition-all duration-300 shadow hover:shadow-lg w-full sm:w-auto"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                </svg>

                Modifier une note
            </button>

        </div>
    </div>


    <!-- SECTION AJOUT NOTE -->
    <div @class([
        'bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl p-3 shadow-sm flex flex-col justify-between'
    ])>

        <!-- HEADER -->
        <div class="">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                Nouvelle Note
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-300 leading-relaxed">
                Ajouter rapidement une nouvelle note pour un étudiant.
            </p>
        </div>

        @php
            $role = Auth::user()->roles->first()->nom ?? '';

            $isAdmin = $role == "Administrateur";
            $isSecretaireGenerale = $role == "Secrétaire générale";
            $doyenFaculte = $role == "Doyen de faculté";
        @endphp

        <!-- BUTTON -->
        @if (!$isAdmin && !$isSecretaireGenerale && !$doyenFaculte)

            <button
                @click="
                    if (@js($periodeOuverte)) {
                        form = !form
                    } else {
                        window.dispatchEvent(new CustomEvent('error-periode'))
                    }
                "
                class="w-full flex items-center justify-center gap-3 bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white py-3 rounded-xl transition-all duration-300 shadow hover:shadow-xl"
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Ajouter une nouvelle note

            </button>

        @endif


        @if ($isAdmin || $isSecretaireGenerale || $doyenFaculte)

            <button
                @click="form = !form"
                class="w-full flex items-center justify-center gap-3 bg-ugnh-blueFonce hover:bg-ugnh-blueHover text-white py-3 rounded-xl transition-all duration-300 shadow hover:shadow-xl"
            >

                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Ajouter une nouvelle note

            </button>

        @endif

    </div>


    <!-- ALERT -->
    <div
        x-data="{ show:false }"

        x-on:error-periode.window="
            show = true;
            setTimeout(() => show = false, 3000)
        "

        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"

        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"

        class="fixed top-5 right-5 bg-red-600 text-white px-5 py-4 rounded-2xl shadow-2xl z-50"
    >

        <div class="flex items-center gap-3">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m0 3.75h.007v.008H12v-.008zm8.25-.75a8.25 8.25 0 11-16.5 0 8.25 8.25 0 0116.5 0z" />
            </svg>

            <span class="font-medium">
                La période de saisie des notes est fermée
            </span>

        </div>

    </div>

</div>
