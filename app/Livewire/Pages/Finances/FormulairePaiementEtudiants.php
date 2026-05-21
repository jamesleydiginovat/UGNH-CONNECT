<?php

namespace App\Livewire\Pages\Finances;

use App\Events\addedTransactionPaiement;
use App\Events\updatedTable;
use App\Models\annnee_accademiqueModel;
use App\Models\documentsModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\facultes_prices;
use App\Models\fichePaiementEtudiant;
use App\Models\notificationModel;
use App\Models\paimentEtudiantModel;
use App\Models\transactionPaiementModel;
use App\Models\utilisateurModel;
use Livewire\Attributes\On;
use Livewire\Component;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;

class FormulairePaiementEtudiants extends Component
{
    public $rechercherEtudiant;

    public $numTransaction;
    public $matriculeEtudiant;
    public $codeFaculte;
    public $nomFac; //pas important pour le backend
    public $montant;
    public $modePaiement;
    public $dateTransaction;
    public $statut;
    public $motifPaiement;
    public $niveau;
    public $session;
    public $premierVersement;
    public $deuxiemeVersement;
    public $troisiemeVersement;
    public $total;


    public $premierVersementS2;
    public $deuxiemeVersementS2;
    public $troisiemeVersementS2;
    public $totalS2;


    public $tatut;

    public $oldTotalS1;
    public $oldTotalS2;

    public $oldPrixTotalS1;
    public $oldPrixTotalS2;

    private $paimentFullPlus;

    public etudiantModel $etudiant;

    public $anneeAccademique;

    public $traitementOK=false;


    public $newMatricule;
    public $cheminPDF;

    public $min;
    public $min_speciale=null;


    public function rules()
    {
        return [
            'numTransaction' => 'required|string|max:50|unique:transaction_paiements,numeroTransaction',

            'matriculeEtudiant' => 'required|string|max:50|exists:etudiants_tb,matricule',

            'codeFaculte' => 'required|string|max:20|exists:facultes,codeFac',

            'montant' => 'required|numeric',

            'modePaiement' => 'required|string|max:50',

            'dateTransaction' => 'required|date',
        ];
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


    public function messages()
    {
        return [
            'numTransaction.required' => 'Le numéro de transaction est requis.',
            'numTransaction.unique' => 'Ce numéro de transaction est déjà utilisé.',

            'matriculeEtudiant.required' => 'Le matricule de l’étudiant est requis.',
            'matriculeEtudiant.exists' => 'Le matricule indiqué ne correspond à aucun étudiant.',

            'codeFaculte.required' => 'La faculté doit être précisée.',
            'codeFaculte.exists' => 'La faculté sélectionnée est invalide.',

            'montant.required' => 'Veuillez indiquer un montant.',
            'montant.numeric' => 'Le montant doit être une valeur numérique.',
            'montant.min' => 'Le montant saisi semble incorrect.',

            'modePaiement.required' => 'Le mode de paiement doit être renseigné.',

            'dateTransaction.required' => 'La date de la transaction est requise.',
            'dateTransaction.date' => 'La date indiquée n’est pas valide.',

            'statut.required' => 'Le statut doit être défini.',

            'motifPaiement.max' => 'Le motif est trop long.',
        ];
    }

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }

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
    public $codeFacSelect;
    public $niveauSelect;
    public function getEtudiantsProperty()
    {
        return etudiantModel::with('faculte')
            ->where('status', 'Etudiant')

            // 🔐 Faculté liée à l'utilisateur connecté
            ->when($this->getCodeFac(), function ($q) {
                $q->whereHas('faculte', function ($sub) {
                    $sub->where('codeFac', $this->getCodeFac());
                });
            })

            // ✅ Faculté + Niveau ensemble
            ->when($this->codeFacSelect && $this->niveauSelect, function ($q) {

                // filtre faculté
                $q->whereHas('faculte', function ($sub) {
                    $sub->where('codeFac', $this->codeFacSelect);
                });

                // filtre niveau
                $q->where('niveau', $this->niveauSelect);
            })

            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getEtudiantSelectProperty(){
        return etudiantModel::with('faculte')->where('status','Etudiant')->where('nom', 'ILIKE', "%{$this->rechercherEtudiant}%")->orderBy('id','DESC')->get();
    }

    public function mount(){
        $this->anneeAccademique = $this->anneeAccademiqueActive()->libelle;
        $this->dateTransaction= now()->format('Y-m-d');
        $this->numTransaction=$this->genererNumeroTransaction();

    }


    public function genererNumeroTransaction()
    {
        $annee = date('Y');

        $dernier = transactionPaiementModel::whereYear('created_at', $annee)
                    ->orderBy('id', 'desc')
                    ->first();

        if ($dernier && $dernier->numeroTransaction) {

            $numero = intval(substr($dernier->numeroTransaction, -5)) + 1;

        } else {

            $numero = 1;

        }

        return 'TRX-' . $annee . '-' . str_pad($numero, 5, '0', STR_PAD_LEFT);
    }


    public function remplirForm()
    {
        if ($this->matriculeEtudiant != null) {

            $etudiant = etudiantModel::with('faculte')
                ->where('status', 'Etudiant')
                ->where('matricule', $this->matriculeEtudiant)
                ->first();

            if ($etudiant) {

                $this->etudiant = $etudiant;
                //verifier si etudiant payer deja un montant
                $etudiantPaiement = paimentEtudiantModel::where('matriculeEtudiant',$this->matriculeEtudiant)->first();

                $this->fill([
                    'codeFaculte' => $etudiant->faculte->first()?->codeFac ?? null,
                    'nomFac'=>($etudiant->faculte->first()?->nom ?? null)." ( Niveau: ".$etudiant->niveau." )",
                    'niveau'=> $etudiant->niveau,
                ]);

                if($etudiantPaiement){
                    $this->fill([
                    $this->motifPaiement=>$etudiantPaiement->first()?->matriculeEtudiant ?? null
                ]);
                }

                

            }
        }
        else{
            $this->reset([
                'nomFac',
                'codeFaculte',
                'matriculeEtudiant'
            ]);            
        }
    }


    public function traitementPaiement(){
        $paiementSessionI = paimentEtudiantModel::where('matriculeEtudiant', $this->matriculeEtudiant)
                        ->where('anneAccademique', $this->anneeAccademique)
                        ->where('session', '1')
                        ->first();

        $paiementSessionII = paimentEtudiantModel::where('matriculeEtudiant', $this->matriculeEtudiant)
                                ->where('anneAccademique', $this->anneeAccademique)
                                ->where('session', '2')
                                ->first();

        $prixSessionI = facultes_prices::where('codeFac', $this->codeFaculte)
                ->where('session', '1')
                ->where('niveau', $this->niveau)
                ->first();

        $prixSessionII = facultes_prices::where('codeFac', $this->codeFaculte)
                        ->where('session', '2')
                        ->where('niveau', $this->niveau)
                        ->first();

        $paiementS1_premierVersement = ($paiementSessionI?->premierVersement ?? 0);
        $paiementS1_deuxiemeVersement = ($paiementSessionI?->deuxiemeVersement ?? 0);
        $paiementS1_troisiemeVersement = ($paiementSessionI?->troisiemeVersement ?? 0);
        $this->oldTotalS1 = ($paiementSessionI?->total ?? 0);

        $this->premierVersement= $paiementS1_premierVersement;
        $this->deuxiemeVersement= $paiementS1_deuxiemeVersement;
        $this->troisiemeVersement= $paiementS1_troisiemeVersement;


        $paiementS2_premierVersement = ($paiementSessionII?->premierVersement ?? 0);
        $paiementS2_deuxiemeVersement = ($paiementSessionII?->deuxiemeVersement ?? 0);
        $paiementS2_troisiemeVersement = ($paiementSessionII?->troisiemeVersement ?? 0);
        $this->oldTotalS2 = ($paiementSessionII?->total ?? 0);

        $this->premierVersementS2= $paiementS2_premierVersement;
        $this->deuxiemeVersementS2= $paiementS2_deuxiemeVersement;
        $this->troisiemeVersementS2= $paiementS2_troisiemeVersement;



        $sessionI_premierVersement = ($prixSessionI?->premierVersement ?? 0);
        $sessionI_deuxiemeVersement = ($prixSessionI?->deuxiemeVersement ?? 0);
        $sessionI_troisiemeVersement = ($prixSessionI?->troisiemeVersement ?? 0);
        $this->oldPrixTotalS1 = ($prixSessionI?->prixTotal ?? 0);

        $sessionII_premierVersement = ($prixSessionII?->premierVersement ?? 0);
        $sessionII_deuxiemeVersement = ($prixSessionII?->deuxiemeVersement ?? 0);
        $sessionII_troisiemeVersement = ($prixSessionII?->troisiemeVersement ?? 0);
        $this->oldPrixTotalS2 = ($prixSessionII?->prixTotal ?? 0);

        $balance = null;

        if($sessionI_premierVersement >= $paiementS1_premierVersement){
           $newMontant_S1_premierVersement = $this->montant + $paiementS1_premierVersement;
           if($newMontant_S1_premierVersement > $sessionI_premierVersement){
              $reste = $newMontant_S1_premierVersement - $sessionI_premierVersement;
              $this->premierVersement = $sessionI_premierVersement;
              $reste += $paiementS1_deuxiemeVersement;
              $this->traitementOK=true;
              if($reste<= $sessionI_deuxiemeVersement){
                $this->deuxiemeVersement = $reste;
                $this->traitementOK=true;
              }
              else{
                $reste2 = $reste - $sessionI_deuxiemeVersement;
                $this->deuxiemeVersement = $sessionI_deuxiemeVersement;
                $reste2 += $paiementS1_troisiemeVersement;
                $this->traitementOK=true;
                // dd($reste2);
                if($reste2 <= $sessionI_troisiemeVersement ){
                    $this->troisiemeVersement = $reste2;
                    $this->traitementOK=true;
                }
                else{
                    $reste3 = $reste2 - $sessionI_troisiemeVersement;
                    $this->troisiemeVersement = $sessionI_troisiemeVersement;
                    
                    $reste3 += $paiementS2_premierVersement;
                    $this->traitementOK=true;
                    // dd($reste3);

                    //deuxieme session
                    if($reste3 <= $sessionII_premierVersement){
                        $this->premierVersementS2 = $reste3;
                        $this->traitementOK=true;
                    }
                    else{
                        $reste4 = $reste3 - $sessionII_premierVersement;
                        $this->premierVersementS2 = $sessionII_premierVersement;
                        $reste4 += $paiementS2_deuxiemeVersement;
                        $this->traitementOK=true;
                        if($reste4 <= $sessionII_deuxiemeVersement){
                            $this->deuxiemeVersementS2 = $reste4;
                            $this->traitementOK=true;
                        }
                        else{
                            $reste5 = $reste4 - $sessionII_deuxiemeVersement;
                            $this->deuxiemeVersementS2 = $sessionII_deuxiemeVersement;
                            $reste5 += $paiementS2_troisiemeVersement;
                            $this->traitementOK=true;
                            if($reste5 <= $sessionII_troisiemeVersement){
                                $this->troisiemeVersementS2 = $reste5;
                                $this->traitementOK=true;
                            }
                            else{
                                $this->troisiemeVersementS2 =$paiementS2_troisiemeVersement;
                                // dd($this->troisiemeVersementS2);
                                $balance = ($this->oldPrixTotalS1+$this->oldPrixTotalS2) - ($this->oldTotalS1+$this->oldTotalS2);
                                $this->paimentFullPlus = "Desole le paiement ne peux pas effectuer car le montant entree est plus haut que la balance de cet etudiant pour cette annee accademique. ".$this->etudiant->nom." ".$this->etudiant->prenom." n'a que ".$balance. " gourdes dans sa balance";
                                $this->traitementOK=false;
                            }
                        }
                    }

                }
              }
           }
           else{
            $this->premierVersement =$newMontant_S1_premierVersement;
            $this->traitementOK=true;
           }
           if($balance !=null){
            $this->min_speciale = $balance;
           }
        }
        // dd($this->traitementOK);  
    }

    public function resetForm(){
       $this->reset([
            'numTransaction',
            'matriculeEtudiant',
            'codeFaculte',
            'montant',
            'nomFac',
            'modePaiement',
            'motifPaiement',
        ]);
        $this->numTransaction=$this->genererNumeroTransaction();
    }


    public function save(){
        // dd("jamesley");
        $this->statut='Valide';
        $this->session='1';
        $paiementEffectue = false;
        $session_transaction=null;
        $validatedData = $this->validate();
        // dd("jamesley");
        $this->traitementPaiement();

        if($this->min_speciale!=null){
            $this->min = $this->min_speciale;
        }
        else{
            $this->min= 500;
        }
        
        $this->validate([
            'montant' => 'required|numeric|min:'. $this->min
        ]);

        $this->total=$this->premierVersement + $this->deuxiemeVersement + $this->troisiemeVersement;
        $this->totalS2=$this->premierVersementS2 + $this->deuxiemeVersementS2 + $this->troisiemeVersementS2;

        // Vérifier si l'enregistrement existe déjà
        $paiement = paimentEtudiantModel::where('matriculeEtudiant', $this->matriculeEtudiant)
            ->where('anneAccademique', $this->anneeAccademique)
            ->where('codeFaculte', $this->codeFaculte)
            ->where('niveau', $this->niveau)
            ->where('session', $this->session)
            ->first();
        
        // Vérifier si l'enregistrement existe déjà pour session 2
        $paiementS2 = paimentEtudiantModel::where('matriculeEtudiant', $this->matriculeEtudiant)
            ->where('anneAccademique', $this->anneeAccademique)
            ->where('codeFaculte', $this->codeFaculte)
            ->where('niveau', $this->niveau)
            ->where('session', 2)
            ->first();
    if($this->traitementOK){

    
        if($this->oldTotalS1 < $this->oldPrixTotalS1){
            if ($paiement) {
            // L'enregistrement existe, vérifier si des champs ont changé
            $fieldsToUpdate = [];

            if ($paiement->premierVersement != $this->premierVersement  ) {
                $fieldsToUpdate['premierVersement'] = $this->premierVersement;
                $this->motifPaiement='Premier versement session 1';
            }

            if ($paiement->deuxiemeVersement != $this->deuxiemeVersement) {
                $fieldsToUpdate['deuxiemeVersement'] = $this->deuxiemeVersement;
                $this->motifPaiement='Deuxieme versement session 1';
            }

            if ($paiement->troisiemeVersement != $this->troisiemeVersement) {
                $fieldsToUpdate['troisiemeVersement'] = $this->troisiemeVersement;
                $this->motifPaiement='Troisieme versement session 1';
            }

            if ($paiement->total != $this->total) {
                $fieldsToUpdate['total'] = $this->total;
            }

            if ($paiement->statut != $this->statut) {
                $fieldsToUpdate['statut'] = $this->statut;
            }

            // Mettre à jour uniquement si des champs ont changé
            if (!empty($fieldsToUpdate)) {
                $paiement->update($fieldsToUpdate);
                $paiementEffectue = true;
                $session_transaction = '1';
                }

            } else {
                // L'enregistrement n'existe pas, on crée un nouveau
                paimentEtudiantModel::create([
                    'matriculeEtudiant' => $this->matriculeEtudiant,
                    'codeFaculte' => $this->codeFaculte,
                    'anneAccademique'=>$this->anneeAccademique,
                    'niveau' => $this->niveau,
                    'session' => $this->session,
                    'premierVersement' => $this->premierVersement ?? 0,
                    'deuxiemeVersement' => $this->deuxiemeVersement ?? 0,
                    'troisiemeVersement' => $this->troisiemeVersement ?? 0,
                    'total' => $this->total,
                    'statut' => $this->statut
                ]);
                $this->motifPaiement='Paiement session 1';
                $paiementEffectue = true;
                $session_transaction = '1';
            }


            if($this->total == $this->oldPrixTotalS1){

                paimentEtudiantModel::create([
                    'matriculeEtudiant' => $this->matriculeEtudiant,
                    'codeFaculte' => $this->codeFaculte,
                    'anneAccademique'=>$this->anneeAccademique,
                    'niveau' => $this->niveau,
                    'session' => 2,
                    'premierVersement' => $this->premierVersementS2 ?? 0,
                    'deuxiemeVersement' => $this->deuxiemeVersementS2 ?? 0,
                    'troisiemeVersement' => $this->troisiemeVersementS2 ?? 0,
                    'total' => $this->totalS2,
                    'statut' => $this->statut
                ]);
                $this->motifPaiement='Paiement session 2';
                $paiementEffectue = true;
                $session_transaction = '1 et 2';
            }

        }
        else{
           
            if ($paiementS2) {
            // dd($this->premierVersementS2);
            // L'enregistrement existe, vérifier si des champs ont changé
            $fieldsToUpdate = [];

            if ($paiementS2->premierVersement != $this->premierVersementS2  ) {
                $fieldsToUpdate['premierVersement'] = $this->premierVersementS2;
                $this->motifPaiement='Permier versement session 2';
            }

            if ($paiementS2->deuxiemeVersement != $this->deuxiemeVersementS2) {
                $fieldsToUpdate['deuxiemeVersement'] = $this->deuxiemeVersementS2;
                $this->motifPaiement='Deuxieme versement session 2';
            }

            if ($paiementS2->troisiemeVersement != $this->troisiemeVersementS2) {
                $fieldsToUpdate['troisiemeVersement'] = $this->troisiemeVersementS2;
                $this->motifPaiement='Troisieme versement session 2';
            }

            if ($paiementS2->total != $this->totalS2) {
                $fieldsToUpdate['total'] = $this->totalS2;
            }

            if ($paiementS2->statut != $this->statut) {
                $fieldsToUpdate['statut'] = $this->statut;
            }

            // Mettre à jour uniquement si des champs ont changé
            if (!empty($fieldsToUpdate)) {
                $paiementS2->update($fieldsToUpdate);
                $paiementEffectue = true;
                $session_transaction = '2';
            }

            } else {
                // L'enregistrement n'existe pas, on crée un nouveau
                paimentEtudiantModel::create([
                    'matriculeEtudiant' => $this->matriculeEtudiant,
                    'codeFaculte' => $this->codeFaculte,
                    'anneAccademique'=>$this->anneeAccademique,
                    'niveau' => $this->niveau,
                    'session' => 2,
                    'premierVersement' => $this->premierVersementS2 ?? 0,
                    'deuxiemeVersement' => $this->deuxiemeVersementS2 ?? 0,
                    'troisiemeVersement' => $this->troisiemeVersementS2 ?? 0,
                    'total' => $this->totalS2,
                    'statut' => $this->statut
                ]);
                $this->motifPaiement='Paiement session 2';
                $paiementEffectue = true;
                $session_transaction = '2';
            }
        }
        
        if($paiementEffectue){
            transactionPaiementModel::create([
            'numeroTransaction' => $this->numTransaction,
            'matriculeEtudiant' => $this->matriculeEtudiant,
            'codeFaculteEtudiant' => $this->codeFaculte,
            'anneAccademique'=>$this->anneeAccademique,
            'montant' => $this->montant,
            'modePaiement' => $this->modePaiement,
            'dateTransaction' => $this->dateTransaction,
            'statut' => $this->statut,
            'motif' => $this->motifPaiement,
            'niveau'=>$this->niveau,
            'session'=> $session_transaction
        ]);
         
         // 🔹 6. Préparer export
        $this->newMatricule = $this->matriculeEtudiant;


        $date = now()->format('Y-m-d_H-i-s');
        // 📁 Nom du fichier
        $titres = "recu_";
        $titreFichier = preg_replace('/[^A-Za-z0-9\-]/', '_', $titres);
        $filename = trim($titreFichier).$this->numTransaction.'.pdf';

        $this->dispatch('success', message: "Paiement effectuer avec succes !");
        $action ="Enregistrement d'un paiement pour un etudiant ";
        $audit = audit(Auth::user()->personnel->code, $action, $this->numTransaction);

        // $etudiantPaie = etudiantModel::where('matricule', $this->newMatricule)->first();
        // $transactionPaie = transactionPaiementModel::where('numeroTransaction',$this->numTransaction)->first();
        
        //NOTIFICATION 
            $message = 'Votre paiement de '. $this->montant.' HTG a été enregistré avec succès.
                        Transaction n° '. $this->numTransaction;

            notificationModel::create([
            'notification_id'=> $audit->id,
            'user_id'=>$this->newMatricule,
            'message'=>$message
            ]);

            //FIN NOTIFICATION
        // broadcast(new addedTransactionPaiement(Auth::user(), $etudiantPaie,$transactionPaie));


        
        broadcast(new updatedTable(''));
        // 🔥 IMPORTANT : on déclenche export après save
        $this->dispatch('export-ready',titres:$titres,filename:$filename, numeroTransaction: $this->numTransaction );
        $this->resetForm();
        }


        
    }
    else{
        
        if($this->paimentFullPlus){
            $this->dispatch('erreur', message: $this->paimentFullPlus);
        }
    }
        
    }



    #[On('export-ready')] 
    public function export($titres, $filename, $numeroTransaction)
    {
        // 🔹 Récupération des données
        $matricule = $this->newMatricule;

        $etudiant = etudiantModel::with('faculte')
                    ->where('matricule', $matricule)
                    ->first();

        $transaction = transactionPaiementModel::where('numeroTransaction', $numeroTransaction)->first();

        // 🔹 Vérification
        if (!$etudiant || !$transaction) {

            $this->dispatch(
                'erreur',
                message: 'Étudiant ou transaction introuvable'
            );

            return;
        }

        // 🔹 Génération PDF
        $pdf = Pdf::loadView('tamplate.pdf.recuPaiementEtudiant', [

            'etudiant' => $etudiant,
            'titre' => $titres,
            'matricule' => $matricule,
            'transaction' => $transaction,
            'numeroTransaction' => $numeroTransaction

        ])
        ->setOption('enable-local-file-access', true)

        ->setOption('page-width', '210mm')
        ->setOption('page-height', '99mm')

        ->setOption('disable-smart-shrinking', true)
        ->setOption('no-pdf-compression', true)

        ->setOption('margin-top', '1mm')
        ->setOption('margin-bottom', '1mm')
        ->setOption('margin-left', '1mm')
        ->setOption('margin-right', '1mm');

        // 📁 Chemin
        $path = storage_path('app/public/pdf/' . $filename);

        // 💾 Save
        $pdf->save($path);

        $this->cheminPDF = $filename;

        // 🔹 Enregistrer fiche
        fichePaiementEtudiant::create([
            'pdf' => $filename,
            'matricule' => $matricule,
            'codeTransaction' => $numeroTransaction,
            'anneAcademique' => optional(
                annnee_accademiqueModel::where('active', true)->first()
            )->libelle,
        ]);

        // 🔹 Broadcast
        broadcast(new updatedTable(''));

        // 🔹 Notification
        $this->dispatch(
            'success-pdffiche',
            filename: $filename
        );

        // 🔹 Audit
        $action = "Generation d'un recu de paiement pour un etudiant";

        audit(
            Auth::user()->personnel->code,
            $action,
            $filename
        );

        // 🔹 Reset
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.finances.formulaire-paiement-etudiants');
    }
}
