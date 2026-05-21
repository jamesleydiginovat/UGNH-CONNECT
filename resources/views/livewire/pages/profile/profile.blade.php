<section 
    x-data="{ edit: false }"
    class="m-3 rounded-2xl p-6 bg-white dark:bg-gray-900 dark:border dark:border-gray-700 text-gray-700 dark:text-gray-200"
>

    <div class="flex flex-col lg:flex-row gap-6">

        {{-- MENU --}}
        <div class="lg:w-1/5 w-full border-r border-gray-200 dark:border-gray-700 pr-4">
            <nav>
                <ul class="space-y-2 text-sm">
                    <li class="p-2 rounded-lg hover:bg-ugnh-blueHover hover:text-white cursor-pointer">Profile</li>
                    <li class="p-2 rounded-lg hover:bg-ugnh-blueHover hover:text-white cursor-pointer">Notification</li>
                    <li class="p-2 rounded-lg hover:bg-ugnh-blueHover hover:text-white cursor-pointer">Historique</li>
                    <li class="p-2 rounded-lg hover:bg-ugnh-blueHover hover:text-white cursor-pointer">Sécurité</li>
                </ul>
            </nav>
        </div>

        {{-- CONTENT --}}
        <div class="lg:w-4/5 w-full space-y-6">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-center bg-ugnh-blueClair dark:bg-gray-800 p-5 rounded-2xl">

                <div class="flex items-center gap-5">
                    <img class="h-20 w-20 rounded-full object-cover border"
                        src="{{ Storage::url('profileUtilisateur/'.Auth::user()->photo) }}">

                    <div>
                        <h1 class="text-xl font-bold">
                            {{ Auth::user()->personnel->nom }} {{ Auth::user()->personnel->prenom }}
                        </h1>
                        <p class="text-sm opacity-70">{{ Auth::user()->nomUtilisateur }}</p>
                        <p class="text-xs opacity-60">{{ Auth::user()->personnel->fonction }}</p>
                    </div>
                </div>

                <button
                    @click="edit = !edit"
                    class="mt-4 md:mt-0 px-4 py-2 rounded-xl bg-ugnh-blueFonce text-white hover:bg-ugnh-blueHover transition"
                >
                    Modifier profil
                </button>

            </div>

            {{-- FORM --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border dark:border-gray-700">

                <div class="flex justify-between items-center mb-5">
                    <h2 class="font-bold text-lg">Informations personnelles</h2>

                    <div class="flex gap-2" x-show="edit">
                        <button
                            wire:click="saveProfile"
                            class="bg-green-600 text-white px-4 py-1 rounded-lg text-sm"
                        >
                            Sauvegarder
                        </button>

                        <button
                            @click="edit = false"
                            class="bg-gray-400 text-white px-4 py-1 rounded-lg text-sm"
                        >
                            Annuler
                        </button>
                    </div>
                </div>

                <form class="space-y-4">

                    {{-- CODE --}}
                    <div>
                        <label class="text-sm font-semibold">Code</label>
                        <input disabled
                            value="{{ Auth::user()->personnel->code }}"
                            class="w-full p-2 rounded-lg bg-gray-100 dark:bg-gray-700">
                    </div>

                    {{-- NOM / PRENOM --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm font-semibold">Nom</label>
                            <input
                                @readonly(true)
                                wire:model="nom"
                                :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Prénom</label>
                            <input
                                @readonly(true)
                                wire:model="prenom"
                                :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>
                    </div>

                    {{-- SEXE / TEL --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm font-semibold">Sexe</label>
                            <input @readonly(true) wire:model="sexe" :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Téléphone</label>
                            <input wire:model="telephone" :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>
                    </div>

                    {{-- ADRESSE / EMAIL --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm font-semibold">Adresse</label>
                            <input wire:model="adresse" :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Email</label>
                            <input wire:model="email" :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>
                    </div>

                    {{-- FONCTION / ETAT --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm font-semibold">Fonction</label>
                            <input @readonly(true) wire:model="fonction" :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Mot de passe</label>
                            <input wire:model="motDePasse" :disabled="!edit"
                                class="w-full p-2 rounded-lg border dark:bg-gray-700">
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

</section>