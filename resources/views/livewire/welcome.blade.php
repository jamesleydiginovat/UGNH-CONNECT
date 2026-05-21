<section class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">

    <!-- 🔷 HEADER -->
    {{-- <div class="flex justify-between items-center px-6 py-4 bg-white dark:bg-gray-800 shadow">
        <h1 class="text-lg font-bold text-gray-800 dark:text-white">
            🎓 Plateforme Universitaire
        </h1>

        <a href="{{ url('/login') }}"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Se connecter
        </a>
    </div> --}}

    <!-- 🧠 PRESENTATION -->
    <div class="text-center px-6 py-10 max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white">
            Bienvenue sur votre plateforme universitaire
        </h2>

        <p class="mt-4 text-gray-600 dark:text-gray-400 leading-relaxed">
            Cette application regroupe les outils essentiels pour le fonctionnement académique 
            de l’université. Elle permet aux étudiants et au personnel d’accéder facilement 
            aux informations, aux activités et aux services numériques.
        </p>
    </div>


    <div class="text-center px-6 pb-12 max-w-3xl mx-auto">

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 md:p-8">

            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                🔐 Accéder à votre espace
            </h3>

            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                Entrez votre matricule ou votre code d’accès pour continuer
            </p>

            <form wire:submit="verify" class="mt-6 flex flex-col md:flex-row gap-3">

                <div class="w-full relative">
                    <input
                        wire:model.live="kod" 
                        type="text"
                        placeholder="Ex : 22ETU001 ou CODE123"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 
                        bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white
                        focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                    >
                </div>

                <button
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow"
                >
                    Accéder
                </button>

            </form>

        </div>

    </div>
    <!-- 🔀 CHOIX DES ESPACES -->

    <div class="grid md:grid-cols-2 gap-8 px-6 max-w-5xl mx-auto">

        <!-- 🏫 GESTION -->
        <a href="{{ ($userType === 'personnel') ? url('/connexion') : '#' }}"
            class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow hover:shadow-lg transition border"
            style="{{ ($userType !== 'personnel') ? 'pointer-events: none; opacity: 0.5; cursor: not-allowed;' : '' }}">

            <h3 class="text-xl font-semibold text-green-600">
                🏫 Espace de gestion universitaire
            </h3>

            <p class="mt-3 text-gray-500 dark:text-gray-400">
                Réservé au personnel administratif. Permet de gérer les étudiants, 
                les inscriptions, les cours, ainsi que les opérations académiques 
                et financières de l’université.
            </p>

            <p class="mt-4 text-sm text-gray-400">
                Accès sécurisé – personnel autorisé uniquement
            </p>
        </a>

        <!-- 💻 E-SALLE -->
        <a href="{{ ($userType === 'etudiant' || $userType === 'professeur') ? url('/esalle') : '#' }}"
            class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow hover:shadow-lg transition border"
            style="{{ (!in_array($userType, ['etudiant','professeur'])) ? 'pointer-events: none; opacity: 0.5; cursor: not-allowed;' : '' }}">

            <h3 class="text-xl font-semibold text-blue-600">
                💻 E-Salle (Espace étudiant & professeur)
            </h3>

            <p class="mt-3 text-gray-500 dark:text-gray-400">
                Espace numérique destiné aux étudiants et aux enseignants. 
                Consultez les notes, suivez les activités académiques, 
                recevez et remettez les devoirs en ligne.
            </p>

            <p class="mt-4 text-sm text-gray-400">
                Accès aux services pédagogiques
            </p>
        </a>

    </div>
    <!-- 📚 INFORMATIONS -->
    <div class="mt-12 px-6 max-w-4xl mx-auto text-center">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
            Une plateforme centralisée
        </h3>

        <p class="mt-3 text-gray-500 dark:text-gray-400">
            L’objectif de cette plateforme est de simplifier l’accès aux services universitaires,
            d’améliorer la communication entre les acteurs académiques et d’assurer une meilleure 
            organisation des activités.
        </p>
    </div>

    <!-- 🔻 FOOTER -->
    <div class="mt-auto text-center py-6 text-gray-400 text-sm">
        © {{ date('Y') }} Université — Tous droits réservés
    </div>

</section>