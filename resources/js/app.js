import './bootstrap';
import './echo';

window.Echo.channel('refresh')
    .listen('.updatedTable', (e) => {
        // console.log('🔥 EVENT REÇU', e);
        Livewire.dispatch('refreshTable');
    });




function showNotification(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-green-600 to-emerald-500 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}

window.Echo.private('admin-notifications')
    .listen('.user.loggedin', (e) => {

        console.log('👤 utilisateur connecté:', e.user);
        Livewire.dispatch('refreshLogin');
        showNotification(e.user.nomUtilisateur + ' vient de se connecter');
    });





function showNotification_out(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-red-900 to-red-300 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}



window.Echo.private('admin-notifications-out')
    .listen('.user.loggedOut', (e) => {

        console.log('👤 utilisateur deconnecté:', e.user);
        Livewire.dispatch('refreshLogOut');
        showNotification_out(e.user.nomUtilisateur + ' vient de se deconnecter');
    });


function showNotification_finance(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-yellow-900 to-yellow-300 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}




window.Echo.private('admin-notifications-finance')
.listen('.daily.payment.summary', (e) => {
    console.log('📊 Résumé du jour:', e);

    showNotification_finance(
        `📊 ${e.count} paiements enregistrés aujourd’hui`
    );
});








function showNotification_personnel(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-green-600 to-emerald-500 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}



window.Echo.private('modifier-personnel-notif')
.listen('.modification-personnel', (e) => {
    console.log('👤 Personnel modifier:', e);
    Livewire.dispatch('refreshPersonnel');
    showNotification_personnel(e.personnel.nom +' ' +e.personnel.prenom + ' vient de modifier par' + ' '+ e.user.nomUtilisateur);
});







function showNotification_personnel_Ajouter(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-green-600 to-emerald-500 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}




window.Echo.private('added-personnel-notif')
.listen('.created-personnel', (e) => {
    console.log('👤 Personnel Ajouter:', e);
    Livewire.dispatch('refreshPersonnel');
    showNotification_personnel_Ajouter(e.personnel.nom +" " +e.personnel.prenom + " vient d'ajouter par" + " "+ e.user.nomUtilisateur);
});



function showNotification_personnel_supprimer(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-red-900 to-red-400 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}




window.Echo.private('deleted-personnel-notif')
.listen('.deleted-personnel', (e) => {
    console.log('👤 Personnel supprimer:', e);
    Livewire.dispatch('refreshPersonnel');
    showNotification_personnel_supprimer(e.personnel.nom +" " +e.personnel.prenom + " vient de supprimer par" + " "+ e.user.nomUtilisateur);
});



function showNotification_etudiant_status(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-yellow-900 to-yellow-400 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}




window.Echo.private('statusChanged-etudiant-notif')
.listen('.statusChanged-etudiant', (e) => {
    // console.log('👤 Personnel supprimer:', e);
    Livewire.dispatch('refreshEtudiant');
    showNotification_etudiant_status(e.etudiant.nom +" " +e.etudiant.prenom + " est "+ e.status +" par "+ e.user.nomUtilisateur);
});


function showNotification_added_cours(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-yellow-900 to-yellow-400 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}

window.Echo.private('added-cours-notif')
.listen('.added-cours', (e) => {
    // console.log('👤 Personnel supprimer:', e);
    Livewire.dispatch('refreshCours');
    showNotification_added_cours(e.user.personnel.nom +" "+e.user.personnel.prenom + " a ajoute un nouveau cours. Le cours:"+ e.cours.nom );
});


function showNotification_deleted_cours(message) {
    const div = document.createElement('div');

    div.className = `
        fixed top-5 right-0 translate-x-full 
        bg-gradient-to-r from-red-900 to-red-400 
        text-white px-5 py-3 rounded-l-xl shadow-xl 
        flex items-center gap-3 z-50
        transition-all duration-500 ease-out
    `;

    div.innerHTML = `
        <div class="text-xl">🔔</div>
        <div class="text-sm font-medium">${message}</div>
    `;

    document.body.appendChild(div);

    // 👉 animation entrée (right → left)
    setTimeout(() => {
        div.classList.remove('translate-x-full');
        div.classList.add('translate-x-0');
    }, 100);

    // 👉 sortie après 4s
    setTimeout(() => {
        div.classList.remove('translate-x-0');
        div.classList.add('translate-x-full');

        setTimeout(() => div.remove(), 500);
    }, 5000);
}

window.Echo.private('deleted-cours-notif')
.listen('.deleted-cours', (e) => {
    // console.log('👤 Personnel supprimer:', e);
    Livewire.dispatch('refreshCours');
    showNotification_deleted_cours(e.user.personnel.nom +" "+e.user.personnel.prenom + " a supprime un nouveau cours. Le cours:"+ e.cours.nom );
});



window.Echo.private('added-transaction-notif')
.listen('.added-transaction', (e) => {
    // console.log('👤 Personnel supprimer:', e);
    Livewire.dispatch('refreshTransaction');
    showNotification_added_transaction("Vous venez de paiement "+ e.transaction.montant +" comme frais d'universite" );
});




