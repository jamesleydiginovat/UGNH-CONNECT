<?php

namespace App\Livewire\Pages\Dossiers;

use App\Models\bultinEtudiantModel;
use App\Models\coursModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\paimentEtudiantModel;
use App\Models\transactionPaiementModel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class DossierPage extends Component
{
    public $id ;

    protected $listeners = [
    'success' => '$refresh',
    'refreshTable'=>'$refresh',
    ];

    #[On('dossier-etudiant')]
    public function setDossierEtudiant($id)
    {
        $this->id = $id;
    }
    


    public function getDossierEtudiantProperty()
    {
        return etudiantModel::find($this->id);
    }

    public function getDossierFinanciereEtudiantProperty()
    {
        if (!$this->dossierEtudiant) {
            return collect();
        }

        $paiements = paimentEtudiantModel::join('faculte_prices', function($join) {
        $join->on('paiement_etudiants.codeFaculte', '=', 'faculte_prices.codeFac')
             ->on('paiement_etudiants.niveau', '=', 'faculte_prices.niveau')
             ->on('paiement_etudiants.session', '=', 'faculte_prices.session');
            })
            ->join('etudiants_tb', 'paiement_etudiants.matriculeEtudiant', '=', 'etudiants_tb.matricule')

            ->select(
                'paiement_etudiants.*',

                'faculte_prices.premierVersement as prixVersement1',
                'faculte_prices.deuxiemeVersement as prixVersement2',
                'faculte_prices.troisiemeVersement as prixVersement3',
                'faculte_prices.prixTotal',

                'etudiants_tb.nom',
                'etudiants_tb.prenom',
                'etudiants_tb.matricule'
            )

            ->where('etudiants_tb.status', 'Etudiant')
            ->where('etudiants_tb.matricule', $this->dossierEtudiant->matricule)

            ->orderBy('paiement_etudiants.updated_at', 'ASC')
            ->get()

            ->groupBy([
                'anneAccademique',
                'session'
            ]);

        return $paiements;

        // return paimentEtudiantModel::where('matriculeEtudiant',$this->getDossierEtudiantProperty($this->id)->matricule)
        //                              ->get()->groupBy(['anneAccademique', 'session']);
    }
    public $anneAcademique;
    public function setAnneAcademique( $annesAcc){
        $this->anneAcademique = $annesAcc;
        return $annesAcc;
        
    }

    public function getFaculteEtudiant($matricule){
         return etudianFaculteModel::with('faculte')->where('matriculeEtudiant', $matricule)->first();
    }


    public function getCours($matricule, $niveau,  $anneAcademique, $session)
    {
        return coursModel::where('codeFac', $this->getFaculteEtudiant($matricule)->codeFaculte)
            ->where('niveau', $niveau)
            ->where('session', $session)
            ->get();
    }


    public function getNoteDetail($session, $annee,$matricule)
    {
        // Valeurs sécurisées
        // $faculte = $this->fculte;
        // $niveau = $this->niveau;
        // $session = $this->session;
        // $annee = optional($this->anneeAccademiqueActive())->libelle;

        $notes = DB::table('notes')
            ->join('etudiants_tb', 'notes.matriculeEtudiant', '=', 'etudiants_tb.matricule')
            ->join('cours_tb', 'notes.codeCours', '=', 'cours_tb.codeCours')
            ->where('notes.matriculeEtudiant', $matricule)
            ->where('notes.session', $session)
            ->when($annee, function ($query) use ($annee) {
                $query->where('notes.anneeAcademique', $annee);
            })
            ->select(
                'etudiants_tb.matricule',
                'cours_tb.codeCours as coursCode',
                'cours_tb.nom',
                'notes.*'
            )
            ->get();

        return $notes;
    }


    public function getTransactionByAnnee($annee)
    {
        return transactionPaiementModel::where('matriculeEtudiant', $this->dossierEtudiant->matricule)
            ->where('anneAccademique', $annee)
            ->get();
    }

    public function getbultinsProperty(){
        return bultinEtudiantModel::where('matricule', $this->dossierEtudiant->matricule)->get();
    }

    public function voirLePdf($matricule)
    {   
        $fichier = bultinEtudiantModel::where('matricule', $matricule)->value('pdf');
        $path = asset('storage/pdf/' . $fichier);
        $this->dispatch('oppen-df', url: $path);
        
    }

    public function render() 
    {
        return view('livewire.pages.dossiers.dossier-page');
    }
}
