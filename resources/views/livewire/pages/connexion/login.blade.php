<section 
    class="relative flex items-center justify-center min-h-screen overflow-hidden bg-[#06142E]"
>

    <!-- BACKGROUND -->
    <div class="absolute inset-0">

        <img 
            class="w-full h-full object-cover opacity-20 scale-105"
            src="{{ asset('images/front-ugnh.jpg') }}" 
            alt=""
        >

        <!-- OVERLAY -->
        <div class="absolute opacity-40 inset-0 bg-gradient-to-br from-[#06142E]/95 via-[#0B1F45]/85 to-[#12306B]/95"></div>

    </div>

    <!-- DECORATIONS -->
    <div class="absolute top-[-120px] right-[-120px] w-72 h-72 bg-blue-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-120px] left-[-120px] w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>

    <!-- LOGIN CARD -->
    <form 
        wire:submit="login"

        class="relative z-10 md:w-[450px] w-[95%] backdrop-blur-xl bg-white/95 dark:bg-gray-900/90 border border-white/20 shadow-2xl rounded-3xl p-8 flex flex-col gap-5"
    >

        <!-- LOGO -->
        <div class="flex flex-col items-center">

            <div class="w-20 h-20 rounded-full bg-white shadow-lg p-2 mb-3">
                <img 
                    class="w-full h-full object-contain"
                    src="{{ asset('images/logoUGNH.png') }}" 
                    alt=""
                >
            </div>

            <h1 class="text-3xl font-black text-center text-ugnh-blueFonce uppercase">
                Connexion
            </h1>

            <p class="text-sm text-gray-500 mt-1 text-center">
                Bienvenue sur votre espace universitaire
            </p>

        </div>

        <!-- USERNAME -->
        <div>

            <label 
                for="username"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            >
                Nom d'utilisateur
            </label>

            <div class="relative mt-2">

                <input 
                    wire:model="nomUtilisateur"
                    type="text"
                    id="username"
                    placeholder="Entrez votre nom utilisateur"

                    class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 dark:text-white transition"
                >

            </div>

        </div>

        <!-- PASSWORD -->
        <div 
            x-data="{ showPassword: false }"
        >

            <label 
                for="password"
                class="text-sm font-medium text-gray-700 dark:text-gray-300"
            >
                Mot de passe
            </label>

            <div class="relative mt-2">

                <!-- INPUT -->
                <input 
                    wire:model="password"
                    id="password"

                    :type="showPassword ? 'text' : 'password'"

                    placeholder="••••••••"

                    class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-3 pe-12 outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 dark:text-white transition"
                >

                <!-- BUTTON -->
                <button 
                    type="button"

                    @click="showPassword = !showPassword"

                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500 transition"
                >

                    <!-- OEIL -->
                    <svg 
                        x-show="!showPassword"
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-5 h-5"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <!-- OEIL BARRÉ -->
                    <svg 
                        x-show="showPassword"
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="1.5" 
                        stroke="currentColor" 
                        class="w-5 h-5"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.477 10.488a3 3 0 104.243 4.243" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 014.242 4.242" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.228 6.228L3 3" />
                    </svg>

                </button>

            </div>

        </div>

        <!-- OPTIONS -->
        <div class="flex items-center justify-between text-sm">

            <label class="flex items-center gap-2 text-gray-600 dark:text-gray-400">

                <input 
                    type="checkbox" 
                    class="rounded border-gray-300"
                >

                Se souvenir de moi

            </label>

            <a 
                href="{{ Route('motDePasseOublie')}}"
                class="text-blue-500 hover:text-blue-600 hover:underline"
            >
                Mot de passe oublié ?
            </a>

        </div>

        <!-- BUTTON -->
        <button 
            class="bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-800 hover:to-blue-600 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300"
        >
            Connexion
        </button>

        <!-- FOOTER -->
        <div class="text-center text-xs text-gray-500 dark:text-gray-400 mt-2">
            © 2026 Université UGNH — Tous droits réservés
        </div>

    </form>

    <!-- FOOTER LINKS -->
    <div class="absolute bottom-0 left-0 w-full flex justify-center py-5 z-10">

        <ul class="flex flex-wrap justify-center gap-5 text-sm text-white/80">

            <li>
                <a href="#" class="hover:text-white hover:underline transition">
                    Politique d'utilisation
                </a>
            </li>

            <li>
                <a href="#" class="hover:text-white hover:underline transition">
                    Conditions d'utilisation
                </a>
            </li>

            <li>
                <a href="#" class="hover:text-white hover:underline transition">
                    FAQ / Aide
                </a>
            </li>

        </ul>

    </div>

    <!-- ERROR ALERT -->
    <div
        x-data="{ show: false, message: '' }"

        x-on:error.window="
            show = true;
            message = $event.detail.message;

            setTimeout(() => show = false, 5000);
        "

        x-show="show"

        x-transition

        class="absolute top-5 right-5 z-50"
    >

        <div class="flex items-start gap-3 bg-red-500 text-white px-5 py-4 rounded-2xl shadow-2xl min-w-[300px]">

            <!-- ICON -->
            <div>

                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="w-6 h-6">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />

                </svg>

            </div>

            <!-- MESSAGE -->
            <div>

                <h3 class="font-semibold">
                    Erreur
                </h3>

                <p 
                    class="text-sm text-red-100"
                    x-text="message"
                ></p>

            </div>

        </div>

    </div>

</section>