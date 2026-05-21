<?php

namespace App\Livewire\Pages;

use App\Events\updatedTable;
use App\Models\faculteModel;
use Livewire\Component;
use Illuminate\Support\Str;
use League\Flysystem\MountManager;

class FormulaireFaculte extends Component
{
    public $code;
    public $niveau;
    public $nom;
    public function generateCodeFaculte()
    {
        $last = faculteModel::orderBy('id', 'desc')->first();

        if (!$last || !$last->codeFac) {
            return '0001';
        }

        // extraire numéro
        $number = (int) $last->codeFac;
        $newNumber = $number + 1;

        // format 4 chiffres : 0001, 0039, 0099 etc...
        return str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public function mount(){
        $this->code = $this->generateCodeFaculte();
    }
    

    public function save()
    {
        // 🔹 1. Validation de base
        $this->validate([
            'code' => 'required|string',
            'nom' => 'required|string', // si tu l'utilises autrement
            'niveau' => 'required|integer|max:7',
        ]);

        // 🔹 2. Normalisation du nom (anti doublon intelligent)
        $nomClean = Str::lower(trim(preg_replace('/\s+/', ' ', $this->nom)));

        // 🔹 3. Vérifier si faculté existe déjà (insensible à la casse)
        $exist = faculteModel::get()->contains(function ($fac) use ($nomClean) {
            return Str::lower(trim($fac->nom)) === $nomClean;
        });

        if ($exist) {
            $this->dispatch('error', message: "Cette faculté existe déjà !");
            return;
        }

        // 🔹 4. Vérifier niveau max
        if ($this->niveau > 7) {
            $this->dispatch('error', message: "Le nombre de niveaux ne peut pas dépasser 7 !");
            return;
        }

        // 🔹 5. Générer code automatique
        $code = $this->generateCodeFaculte();

        // 🔹 6. Enregistrer
        faculteModel::create([
            'codeFac' => $code,
            'nom' => $this->nom,
            'nombreNiveau' => $this->niveau,
        ]);

        // 🔹 7. Reset form
        $this->reset(['nom', 'code', 'niveau']);
        $this->code = $this->generateCodeFaculte();
        broadcast(new updatedTable(''));
        $this->dispatch('success', message: "Faculté ajoutée avec succès !");
    }

    public function render()
    {
        return view('livewire.pages.formulaire-faculte');
    }
}
