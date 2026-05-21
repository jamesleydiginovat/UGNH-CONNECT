<?php

namespace App\Livewire\Pages\Cours;

use App\Models\annnee_accademiqueModel;
use App\Models\coursModel;
use App\Models\documentsModel;
use App\Models\faculteModel;
use App\Models\horaireFaculesModel;
use App\Models\professeurModel;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;

class TableauHorairesFac extends Component
{
    public $byFaculte;
    public $byNiveau;
    public $bySession;
    public $cheminPDF;
    protected $listeners = [
    'success' => '$refresh',
    'success-delete'=> '$refresh',
    'refreshTable'=>'$refresh',
    ];

    private function getCodeFac()
    {
        $user = Auth::user();
        $role = $user->roles()->first();

        $value = $role?->pivot?->codeFac;

        if (!empty($value) && !in_array($value, ['null', '[null]'])) {
            return trim($value);
        }

        return null;
    }

    public function getHorairesProperty()
    {
        $query = horaireFaculesModel::with(['faculte', 'prof']);

        // 🎯 filtre faculté manuel
        $query->when($this->byFaculte != "", function ($q) {
            $q->where('codeFac', $this->byFaculte);
        });

        // 🎯 filtre niveau
        $query->when($this->byNiveau != "", function ($q) {
            $q->where('niveau', $this->byNiveau);
        });

        // 🎯 filtre session
        $query->when($this->bySession != "", function ($q) {
            $q->where('session', $this->bySession);
        });

        // 🔐 filtre automatique par rôle (doyen, vice, etc.)
        $query->when($this->getCodeFac(), function ($q) {
            $q->where('codeFac', $this->getCodeFac());
        });

        return $query
            ->get()
            ->groupBy(['codeFac', 'niveau', 'session', 'jour']);
    }

    public function getFacultesProperty()
    {
        $user = Auth::user();

        // 🔐 récupérer le rôle
        $role = $user->roles()->first();

        // 🧹 nettoyer codeFac
        $codeFac = null;

        if ($role && $role->pivot) {
            $value = trim($role->pivot->codeFac);

            if (!empty($value) && !in_array($value, ['null', '[null]'])) {
                $codeFac = $value;
            }
        }

        // 📦 requête de base
        $query = faculteModel::query();

        // 🔐 filtrage automatique par faculté (doyen, vice, etc.)
        $query->when($codeFac, function ($q) use ($codeFac) {
            $q->where('codeFac', 'ILIKE', "%{$codeFac}%");
        });

        return $query->orderBy('id', 'ASC')->get();
    }

    public function nomProf($codeProf){
        $prof = professeurModel::where('codeProf', $codeProf)->first();
         return $prof->nom." ".$prof->prenom;
    }


    public function export()
    {
                // 🔹 1. Récupération sécurisée des données
                // $matricule = $this->newMatricule;
                $horaires = $this->getHorairesProperty();
                $date = now()->format('Y-m-d_H-i-s');
                $titreFichier ="Horaire";
                $pdf = PDF::loadView('tamplate.pdf.documentHoraire', [
                'Horaires' => $horaires,
                'titre'=> $titreFichier
                ])->setOption('enable-local-file-access', true);
                $filename = trim($titreFichier).trim($date).'.pdf';
                // 📁 Chemin de stockage
                $path = storage_path('app/public/pdf/'.$filename);

                // 💾 Enregistrement du fichier
                $pdf->save($path);
                $this->cheminPDF=$filename;
                // (optionnel) retourner le chemin ou message
                // return $path;

                documentsModel::create([
                    'nom'=>$filename,
                    'utilisateurs'=>Auth::user()->nomUtilisateur,
                    'anneeAcademique'=>annnee_accademiqueModel::where('active',true)->first()->libelle
                ]);

                $this->dispatch('success-pdffiche', filename:$filename,);

                audit(Auth::user()->personnel->code, "Generation d'un horaire en pdf", $filename, request()->ip());

    }

    public function render()
    {
        return view('livewire.pages.cours.tableau-horaires-fac');
    }
}
