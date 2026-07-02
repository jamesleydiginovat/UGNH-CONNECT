<section
    x-data="{ edit: false, showPasswordModal: false }"
    class="m-3 p-6 rounded-2xl bg-gray-50 dark:bg-gray-900"
>

    {{-- HEADER PROFIL --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex flex-col md:flex-row items-center justify-between gap-6">

        <div class="flex items-center gap-5">

            <img
                class="h-24 w-24 rounded-full object-cover border-4 border-ugnh-blueFonce"
                src="{{ Storage::url('profileUtilisateur/'.Auth::user()->photo) }}"
            >

            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ Auth::user()->personnel->nom }} {{ Auth::user()->personnel->prenom }}
                </h1>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ Auth::user()->nomUtilisateur }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ Auth::user()->personnel->fonction }}
                </p>
            </div>

        </div>

        <button
            @click="edit = !edit"
            class="px-5 py-2 rounded-xl bg-ugnh-blueFonce text-white hover:bg-ugnh-blueHover transition shadow"
        >
            Modifier profil
        </button>

    </div>

    @if(session()->has('success'))
        <div
            x-data="{ show: true }"
            x-init="
                setTimeout(() => {
                    show = false;
                    $wire.clearFlash();
                }, 2000)
            "
            x-show="show"
            x-transition
            class="mt-4 mb-4 p-4 rounded-lg bg-green-100 text-green-700"
        >
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                Informations personnelles
            </h2>

            <div class="flex gap-2" x-show="edit">

                <button
                    wire:click="saveProfile"
                    class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700"
                >
                    Sauvegarder
                </button>

                <button
                    @click="edit = false"
                    class="px-4 py-2 rounded-lg bg-gray-400 text-white hover:bg-gray-500"
                >
                    Annuler
                </button>

            </div>

        </div>

        <form wire:submit="saveProfile" class="space-y-5 dark:text-gray-50">

            {{-- CODE --}}
            <div>
                <label class="text-sm font-semibold">Code</label>
                <input
                    disabled
                    value="{{ Auth::user()->personnel->code }}"
                    class="w-full mt-1 p-3 rounded-xl bg-gray-100 dark:bg-gray-700"
                >
            </div>

            {{-- NOM / PRENOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-semibold">Nom</label>
                    <input  wire:model="nom" :disabled="edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

                <div>
                    <label class="text-sm font-semibold">Prénom</label>
                    <input wire:model="prenom" :disabled="edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

            </div>


            {{-- SEXE / TEL --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-semibold">Condition matrimoniale</label>

                    <select
                        wire:model="conditionMatrimoniale"
                        :disabled="!edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700"
                    >
                        <option value="">-- Sélectionner --</option>

                        <option value="Célibataire">Célibataire</option>
                        <option value="Marié(e)">Marié(e)</option>
                        <option value="Veuf / Veuve">Veuf / Veuve</option>
                        <option value="Divorcé(e)">Divorcé(e)</option>
                        <option value="Séparé(e)">Séparé(e)</option>
                        <option value="Union libre">Union libre</option>
                        <option value="Fiancé(e)">Fiancé(e)</option>
                    </select>

                </div>

                <div>
                    <label class="text-sm font-semibold">Nom Utilisateur</label>
                    <input wire:model="nomUtilisateur" :disabled="edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

            </div>



            {{-- SEXE / TEL --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-semibold">Sexe</label>
                    <input wire:model="sexe" :disabled="edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

                <div>
                    <label class="text-sm font-semibold">Téléphone</label>
                    <input wire:model="telephone" :disabled="!edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

            </div>

            {{-- ADRESSE / EMAIL --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-semibold">Adresse</label>
                    <input wire:model="adresse" :disabled="!edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input wire:model="email" :disabled="!edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

            </div>

            {{-- FONCTION --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm font-semibold">Fonction</label>
                    <input wire:model="fonction" :disabled="edit"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

                {{-- MOT DE PASSE --}}
                <div>
                    <label class="text-sm font-semibold">Mot de passe</label>

                    <button
                        type="button"
                        @click="showPasswordModal = true"
                        class="w-full mt-1 p-3 rounded-xl border bg-gray-100 dark:bg-gray-700 text-left text-gray-500"
                    >
                        Modifier le mot de passe
                    </button>
                </div>

            </div>

        </form>

    </div>

    {{-- ================= MODAL PASSWORD ================= --}}
    <div
        x-show="showPasswordModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60"
    >

        <div
            @click.away="showPasswordModal = false"
            class="bg-white dark:bg-gray-800 w-full  dark:text-gray-50 max-w-md rounded-2xl shadow-xl p-6"
        >

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-lg font-bold">Changer le mot de passe</h2>

                <button
                    @click="showPasswordModal = false"
                    class="text-red-500 text-xl"
                >
                    ✕
                </button>

            </div>

            <form wire:submit.prevent="updatePassword" class="space-y-4">

                <div>
                    <label class="text-sm font-semibold">Ancien mot de passe</label>
                    <input type="password" wire:model="old_password"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                    @error('old_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Nouveau mot de passe</label>
                    <input type="password" wire:model="new_password"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                    @error('new_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold">Confirmation</label>
                    <input type="password" wire:model="new_password_confirmation"
                        class="w-full mt-1 p-3 rounded-xl border dark:bg-gray-700">
                </div>

                <div class="flex justify-end gap-3 pt-3">

                    <button
                        type="button"
                        @click="showPasswordModal = false"
                        class="px-4 py-2 rounded-lg bg-gray-400 text-white"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 rounded-lg bg-green-600 text-white"
                    >
                        Mettre à jour
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>