<section class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-50 flex h-screen w-full items-center justify-center">

    <form wire:submit="connecter" class="bg-gray-800/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-[90%] max-w-md border border-gray-700 space-y-6">

        <!-- Titre -->
        <div class="text-center">
            <h1 class="text-2xl font-bold">Connexion</h1>
            <p class="text-sm text-gray-400">Entrez votre code d'accès</p>
        </div>

        <!-- Input -->
        <div class="relative">
            <input 
                wire:model.live="password"
                type="password" 
                placeholder="Code secret"
                class="w-full p-3 pl-10 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
            >

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                    d="M16.5 10.5V7.875a4.875 4.875 0 10-9.75 0V10.5m-1.5 0h12a1.5 1.5 0 011.5 1.5v6a1.5 1.5 0 01-1.5 1.5h-12A1.5 1.5 0 014 18v-6a1.5 1.5 0 011.5-1.5z" />
            </svg>
        </div>

        <!-- Bouton -->
        <button 
            class="w-full bg-blue-600 hover:bg-blue-500 transition duration-300 p-3 rounded-lg font-semibold shadow-lg hover:scale-[1.02]"
        >
            Se connecter
        </button>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500">
            Accès sécurisé • Système universitaire
        </p>

    </form>

</section>