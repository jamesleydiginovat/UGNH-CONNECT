<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('admin-notifications', function ($user) {
    return ($user->roles->first()->nom ?? "") === 'Administrateur'; // adapte selon ton système
});

Broadcast::channel('admin-notifications-out', function ($user) {
    return ($user->roles->first()->nom ?? "") === 'Administrateur'; // adapte selon ton système
});


Broadcast::channel('admin-notifications-finance', function ($user) {
    return ($user->roles->first()->nom ?? "") === 'Administrateur'; // adapte selon ton système
});


Broadcast::channel('modifier-personnel-notif', function ($user) {
    $role = $user->roles->first()->nom ?? '';
    return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
});

Broadcast::channel('added-personnel-notif', function ($user) {
    $role = $user->roles->first()->nom ?? '';
    return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
});

Broadcast::channel('deleted-personnel-notif', function ($user) {
    $role = $user->roles->first()->nom ?? '';
    return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
});


Broadcast::channel('statusChanged-etudiant-notif', function ($user) {
    $role = $user->roles->first()->nom ?? '';
    return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
});


Broadcast::channel('added-cours-notif', function ($user) {
    $role = $user->roles->first()->nom ?? '';
    return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
});


Broadcast::channel('deleted-cours-notif', function ($user) {
    $role = $user->roles->first()->nom ?? '';
    return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
});


// Broadcast::channel('added-transaction-notif', function ($user,$etudiantPaie,$transactionPaie) {
//     $etudiant = $etudiantPaie->matricule;
//     return in_array($role, ['Administrateur', 'Secrétaire générale']); // adapte selon ton système
// });