@extends('layouts.app')

@section('topBarre')
    <livewire:inclus.top-barre />
@endsection

@section('main')




<div @class([
    'p-3 bg-white rounded m-3  flex  flex-col  items-center justify-between',
    'lg:flex-row',
    'dark:border-gray-700 dark:border dark:bg-gray-900 '
])>
        
    
    <livewire:pages.utilisateurs.utilisateurs-counter />



<div @class([
    'flex flex-col justify-between gap-1 ps-0 pt-1 w-full',
    'lg:w-[60%] lg:justify-end lg:ps-2 lg:pt-0 '
])>

    <!-- Créer utilisateur -->
    <button @click="form = !form" @class([
        'flex flex-row p-2 rounded gap-2 transition-all duration-300',
        'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
        // DARK MODE
        'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
    ])>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        Créer un utilisateur
    </button>

    <!-- Permission et roles -->
    <button @click="formRolesEtPermission = !formRolesEtPermission" @class([
        'flex flex-row p-2 rounded gap-2 transition-all duration-300',
        'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
        // DARK MODE
        'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
    ])>
        {{-- icône optionnelle supprimée --}}
        Permission et roles
    </button>

</div>
    
<div @class([
    'flex flex-col justify-between gap-1 ps-0 pt-1 w-full',
    'lg:w-1/2 lg:justify-end lg:ps-2 lg:pt-0 '
])>

    <div @class([
        'flex flex-row gap-1 justify-between'
    ])>
    </div>

    <!-- Ajouter un rôle -->
    <button @click="formRoles = !formRoles" @class([
        'flex flex-row p-2 rounded gap-2 transition-all duration-300',
        'bg-ugnh-blueFonce text-gray-50 hover:bg-ugnh-blueHover hover:shadow-lg',
        // DARK MODE
        'dark:bg-gray-900 dark:text-gray-200 dark:border dark:border-gray-600 dark:hover:bg-gray-700'
    ])>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>

        Ajouter un Roles
    </button>

</div>
</div>

<livewire:pages.utilisateurs.tableau-utilisateurs />

<livewire:pages.utilisateurs.formulaire-create-users />

<livewire:pages.roles.create-roles />

<livewire:pages.roles.tableau-permission-et-roles />

@endsection