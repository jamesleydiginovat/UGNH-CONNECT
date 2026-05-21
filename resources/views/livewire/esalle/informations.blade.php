<section class="min-h-screen bg-gray-100 dark:bg-gray-900 p-6">

    <div class="mx-auto bg-white dark:bg-gray-800 rounded-xl shadow p-6">

        <!-- 🧠 Titre -->
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
            Informations personnelles
        </h2>

        <!-- 📌 INFOS -->
        
        <div class="grid md:grid-cols-2 gap-6">

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Nom</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->nom ?? ""}}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Prénom</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->prenom ?? ""}}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Matricule</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->matricule ?? ""}}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Sexe</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->sexe ?? ""}}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Téléphone</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->telephone ?? ""}}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Adresse</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->adresse ?? ""}}</p>
            </div>

        </div>

        <!-- 📚 INFOS ACADÉMIQUES -->
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
            Informations académiques
        </h3>

        <div class="grid md:grid-cols-2 gap-6">

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Faculté</p>
                <p class="font-semibold text-gray-800 dark:text-white">Sciences Informatiques</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Niveau</p>
                <p class="font-semibold text-gray-800 dark:text-white">{{ $this->etudiant->niveau ?? ""}}</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Année académique</p>
                <p class="font-semibold text-gray-800 dark:text-white">2025 - 2026</p>
            </div>

            <div class="p-4 border rounded-lg">
                <p class="text-sm text-gray-500">Statut</p>
                <p class="font-semibold text-green-600">Actif</p>
            </div>

        </div>

        <!-- 📞 RESPONSABLE -->
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mt-8 mb-4">
            Responsable
        </h3>

        <div class="p-4 border rounded-lg">
            <p class="text-sm text-gray-500">Nom du responsable</p>
            <p class="font-semibold text-gray-800 dark:text-white">Mme Jean Marie</p>
        </div>

    </div>

</section>