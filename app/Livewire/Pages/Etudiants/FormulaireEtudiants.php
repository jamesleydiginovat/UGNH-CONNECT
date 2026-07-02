<?php

namespace App\Livewire\Pages\Etudiants;

use App\Events\updatedTable;
use App\Models\annnee_accademiqueModel;
use App\Models\documentsModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Auth;

class FormulaireEtudiants extends Component
{
    use WithFileUploads;
    
    public $dateCreation;
    public $matricule;
    public $nom;
    public $prenom;
    public $sexe;
    public $adresse;
    public $telephone;
    public $dateNaissance;
    public $lieuNaissance;
    public $nif_cin;
    public $groupeSanguin;
    public $conditionMatrimoniale;
    public $email;
    public $occupationAcctuelle;
    public $lieuDeTravail;
    public $nomPrenomPersonneR;
    public $telephonePersonneR;
    public $lien;
    public $PersonneReferences;
    public $niveauBac;
    public $anneeBac;
    public $etablissementBac;
    public $niveauES;
    public $disciplineES;
    public $anneeES;
    public $etablissementES;
    public $photo;
    public $codeFac;

    public $niveau=1;

    public $ids=null;

    public $photoAfficher=null;

    public ?etudiantModel $etudiants=null;

    public $status;
    public $saveOK=false;
    public $newMatricule;
    public $cheminPDF;

    protected $listeners = [
        'success' => '$refresh',
        'edit-etudiant'=>'$refresh',
    ];


    public function rules()
    {

    $seizeAns = Carbon::now()->subYears(16)->format('Y-m-d');
    $A50Ans = Carbon::now()->subYears(16)->format('Y-m-d');
    return [

            'matricule' => [
                'required',
                Rule::unique('etudiants_tb', 'matricule')
                    ->ignore($this->etudiants?->id)
            ],


            'nif_cin' => [
                'required',
                'min:10',
                'max:30',
                Rule::unique('etudiants_tb', 'nif_cin')
                    ->ignore($this->etudiants?->id)
            ],

            'email' => [
                'nullable',
                Rule::unique('etudiants_tb', 'email')
                    ->ignore($this->etudiants?->id)
            ],
            'nom' => 'required|min:3|max:50',
            'prenom' => 'required|min:3|max:50',
            'sexe' => 'required|in:M,F',
            'adresse' => 'required|min:5|max:150',
            'telephone' => 'required|min:8|max:20',
            'dateNaissance' => 'required|date|before_or_equal:' . $seizeAns.'after_or_equal:' .$A50Ans,
            'lieuNaissance' => 'required|min:3|max:100',
            'groupeSanguin' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'conditionMatrimoniale' => 'required',
            'occupationAcctuelle' => 'nullable|min:5|max:100',
            'lieuDeTravail' => 'nullable|min:5|max:100',
            'nomPrenomPersonneR' => 'required|min:5|max:100',
            'telephonePersonneR' => 'required|min:8|max:20',
            'niveauBac' => 'required|in:Bac I,Bac II',
            'anneeBac' => 'required|digits:4',
            'etablissementBac' => 'required|min:5|max:150',
            'niveauES' => 'nullable|max:100',
            'disciplineES' => 'nullable|min:5|max:100',
            'anneeES' => 'nullable|digits:4',
            'etablissementES' => 'nullable|min:5|max:150',
            'photo' => 'nullable'

        ];
    }

    public function messages()
{
    return [

            'matricule.required' => 'Matricule requis',
            'matricule.unique' => 'Matricule déjà utilisé',

            'nom.required' => 'Nom requis',
            'nom.min' => 'Nom trop court',

            'prenom.required' => 'Prénom requis',
            'prenom.min' => 'Prénom trop court',

            'sexe.required' => 'Sélectionnez le sexe',

            'adresse.required' => 'Adresse requise',

            'telephone.required' => 'Téléphone requis',

            'dateNaissance.required' => 'Date de naissance requise',
            'dateNaissance.date' => 'Date invalide',
            'dateNaissance.before_or_equal' => 'L’étudiant doit avoir au moins 16 ans.',

            'lieuNaissance.required' => 'Lieu de naissance requis',

            'email.email' => 'Email invalide',

            'nomPrenomPersonneR.required' => 'Nom de la personne de référence requis',

            'telephonePersonneR.required' => 'Téléphone de référence requis',
            'nif_cin.required' => 'CIN/NIF requis',
            'lien.required' => 'Lien requis',

            'niveauBac.required' => 'Niveau Bac requis',
            'anneeBac.required' => 'Annee Bac requis',
            'etablissementBac.required' => 'Etablissement Bac requis',
            'etablissementES.min' =>'Trop courte',
            'disciplineES.min' =>'Trop courte',
            'lieuDeTravail.min'=>'Trop courte',
            'occupationAcctuelle.min'=>'Trop courte',




        ];
    }


    public function mount()
    {
        $this->dateCreation = now()->format('Y-m-d');
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

    public function getPostulantsProperty(){
        // return etudiantModel::where('status', 'Postulant')->orderBy('id', 'DESC')->get();
         return etudiantModel::with('faculte')->where('status','Postulant')->orderBy('id','DESC')->get();
    }

    public function findCodeFac(){
        return faculteModel::find($this->faculte);
    }

    public function remplirCodeFac(){
        if($this->codeFac!=""){
            $this->generateMatricule($this->codeFac);
        }
        else{
            $this->matricule="";
        }
    }


    private function generateMatricule($codeFac)
    {
        do {
            // Génère  nombre aléatoire à 4 chiffres
            $randomNumber = mt_rand(1000, 9999);

            // Crée le matricule avec le code de la faculté
            $matricule = $codeFac . '-' . $randomNumber;

            // Vérifie si ce matricule existe déjà dans la base de donnee boss la
        } while (etudiantModel::where('matricule', $matricule)->exists());
        $this->matricule= $matricule;
        return $matricule;
    }



    public function resetForm()
    {
        
        $this->reset([
            'matricule',
            'nom',
            'prenom',
            'sexe',
            'adresse',
            'telephone',
            'dateNaissance',
            'lieuNaissance',
            'nif_cin',
            'groupeSanguin',
            'conditionMatrimoniale',
            'email',
            'occupationAcctuelle',
            'lieuDeTravail',
            'nomPrenomPersonneR',
            'telephonePersonneR',
            'lien',
            'PersonneReferences',
            'niveauBac',
            'anneeBac',
            'etablissementBac',
            'niveauES',
            'disciplineES',
            'anneeES',
            'etablissementES',
            'photo',
            'codeFac',
            'dateCreation',
            'codeFac'
        ]);

         $this->dateCreation = now()->format('Y-m-d');
         $this->status="";
    }



    public function save(){


        $validatedData = $this->validate();

        $photoName = null;
        if($this->ids==null){
            if ($this->photo) {

                // récupérer l'extension
                $extension = $this->photo->getClientOriginalExtension();

                // nom de la photo = matricule
                $photoName = $this->matricule . '.' . $extension;
                
            }
            $this->status="Postulant";
            etudiantModel::create([
                'matricule' => $this->matricule,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'sexe' => $this->sexe,
                'adresse' => $this->adresse,
                'telephone' => $this->telephone,
                'dateNaissance' => $this->dateNaissance,
                'lieuNaissance' => $this->lieuNaissance,
                'nif_cin' => $this->nif_cin,
                'groupeSanguin' => $this->groupeSanguin,
                'conditionMatrimoniale' => $this->conditionMatrimoniale,
                'email' => $this->email ?: null,
                'occupationAcctuelle' => $this->occupationAcctuelle ?: null,
                'lieuDeTravail' => $this->lieuDeTravail ?: null,
                'nomPrenomPersonneR' => $this->nomPrenomPersonneR,
                'telephonePersonneR' => $this->telephonePersonneR,
                'lien' => $this->lien ?: null,
                'PersonneReferences' => $this->PersonneReferences,
                'niveauBac' => $this->niveauBac,
                'anneeBac' => $this->anneeBac,
                'etablissementBac' => $this->etablissementBac,
                'niveauES' => $this->niveauES ?: null,
                'disciplineES' => $this->disciplineES,
                'anneeES' => $this->anneeES ?: null,
                'etablissementES' => $this->etablissementES,
                'photo' => $photoName ?: null,
                'status'=>$this->status,
                'niveau'=>$this->niveau,
                'codeFac'=>$this->codeFac
            ]);

            if($photoName!=null){

                // enregistrer dans storage/app/public/photosEtudiants
                $this->photo->storeAs('photosEtudiants', $photoName, 'public');

            }

            // etudianFaculteModel::create([
            //     'matriculeEtudiant'=>$this->matricule,
            //     'codeFaculte'=>$this->codeFac,
            // ]);
            
            // 🔹 6. Préparer export
            $this->newMatricule = $this->matricule;

            $date = now()->format('Y-m-d_H-i-s');
            // 📁 Nom du fichier
            $titres = "Fiche d'inscription";
            $titreFichier = preg_replace('/[^A-Za-z0-9\-]/', '_', $titres);
            $filename = trim($titreFichier).$this->matricule.trim($date).'.pdf';

            // 🔹 7. message succès
            $this->dispatch('success', message: 'Postulant inscrit avec succès!');
            $action ="Inscription d'un postulant";
            audit(Auth::user()->personnel->code, $action, $this->matricule);
            broadcast(new updatedTable(''));

            // 🔥 IMPORTANT : on déclenche export après save
            $this->dispatch('export-ready',titres:$titres,filename:$filename);
            
            
        }
        else{
            // gestion de la photo
            if ($this->photo) {

                $extension = $this->photo->getClientOriginalExtension();
                $photoName = $this->matricule . '.' . $extension;
            } else {

                $photoName = $this->photoAfficher;
            }


            $this->status = $this->etudiants->status;
            $ancienMatricule = $this->etudiants->matricule;

            // remplir les nouvelles valeurs sans sauvegarder
            $this->etudiants->fill([
                'matricule'=>$this->matricule,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'sexe' => $this->sexe,
                'adresse' => $this->adresse,
                'telephone' => $this->telephone,
                'dateNaissance' => $this->dateNaissance,
                'lieuNaissance' => $this->lieuNaissance,
                'nif_cin' => $this->nif_cin,
                'groupeSanguin' => $this->groupeSanguin,
                'conditionMatrimoniale' => $this->conditionMatrimoniale,
                'email' => $this->email ?: null,
                'occupationAcctuelle' => $this->occupationAcctuelle ?: null,
                'lieuDeTravail' => $this->lieuDeTravail ?: null,
                'nomPrenomPersonneR' => $this->nomPrenomPersonneR,
                'telephonePersonneR' => $this->telephonePersonneR,
                'lien' => $this->lien ?: null,
                'PersonneReferences' => $this->PersonneReferences,
                'niveauBac' => $this->niveauBac,
                'anneeBac' => $this->anneeBac,
                'etablissementBac' => $this->etablissementBac,
                'niveauES' => $this->niveauES ?: null,
                'disciplineES' => $this->disciplineES,
                'anneeES' => $this->anneeES ?: null,
                'etablissementES' => $this->etablissementES,
                'photo' => $photoName ?: null,
                'status' => $this->status,
                'niveau' => $this->niveau,
                'codeFac'=>$this->codeFac
                
                
                
                // 'created_at' => $this->dateCreation,
            ]);

            // vérifier s'il y a une modification
            if ($this->etudiants->isDirty()) {
                // etudianFaculteModel::where('matriculeEtudiant', $ancienMatricule)->update([
                // 'matriculeEtudiant'=>$this->matricule,
                // 'codeFaculte'=>$this->codeFac,
                // ]);


                    


                $this->etudiants->save();

                        DB::table('etudiants_faculte')
                            ->where('matriculeEtudiant', $this->matricule)
                            ->update([
                                'codeFaculte' => $this->codeFac
                            ]);

                // sauvegarder la nouvelle photo si elle existe
                if ($this->photo) {
                    $this->photo->storeAs('photosEtudiants', $photoName, 'public');
                }

                
                $this->dispatch('success', message: 'Etudiant modifié avec succès!');
                $action ="Modification d'un etudiant";
                audit(Auth::user()->personnel->code, $action, $this->matricule);
                broadcast(new updatedTable(''));

            } else {

                $this->dispatch('info', message: 'Aucune modification détectée.');
            }
        }

    }
    public function makeIdsNull(){
        $this->ids=null;
        $this->resetErrorBag();
        $this->resetForm();
    }
    #[On('edit-etudiant')]  
    public function edit($id){
            $this->ids=$id;
            $this->etudiants = etudiantModel::with('faculte')->where('id', $id)->first();
            $this->status = $this->etudiants->status;
            $this->photoAfficher =$this->etudiants->photo;
            $this->fill([
                // 'dateCreation' => $this->etudiants->created_at,
                'matricule' => $this->etudiants->matricule,
                'nom' => $this->etudiants->nom,
                'prenom' => $this->etudiants->prenom,
                'sexe' => $this->etudiants->sexe,
                'adresse' => $this->etudiants->adresse,
                'telephone' => $this->etudiants->telephone,
                'dateNaissance' => $this->etudiants->dateNaissance,
                'lieuNaissance' => $this->etudiants->lieuNaissance,
                'nif_cin' => $this->etudiants->nif_cin,
                'groupeSanguin' => $this->etudiants->groupeSanguin,
                'conditionMatrimoniale' => $this->etudiants->conditionMatrimoniale,
                'email' => $this->etudiants->email,
                'occupationAcctuelle' => $this->etudiants->occupationAcctuelle,
                'lieuDeTravail' => $this->etudiants->lieuDeTravail,
                'nomPrenomPersonneR' => $this->etudiants->nomPrenomPersonneR,
                'telephonePersonneR' => $this->etudiants->telephonePersonneR,
                'lien' => $this->etudiants->lien,
                'PersonneReferences' => $this->etudiants->PersonneReferences,
                'niveauBac' => $this->etudiants->niveauBac,
                'anneeBac' => $this->etudiants->anneeBac,
                'etablissementBac' => $this->etudiants->etablissementBac,
                'niveauES' => $this->etudiants->niveauES,
                'disciplineES' => $this->etudiants->disciplineES,
                'anneeES' => $this->etudiants->anneeES,
                'etablissementES' => $this->etudiants->etablissementES,
                // 'photo' => $this->etudiants->photo,
                'codeFac' =>$this->etudiants->faculte->first()?->codeFac ?? '',
                'dateCreation'=> $this->etudiants->created_at->format('Y-m-d'),
                //  'codeFac'=> faculteModel::where('codeFac',$this->etudiants->codeFac)->value('nom')
            ]);

           

    }

    public function deletePostulant($id){
        etudiantModel::find($id)->delete();
        $action ="Supression d'un postulant";
        audit(Auth::user()->personnel->code, $action, $id);
        broadcast(new updatedTable(''));
    }

    public function getnomFac($fac){
        return faculteModel::where('codeFac', $fac)->value('nom');
    }


    public function remplirFromModifier($id){
          $this->edit($id);
        //   $this->dispatch('edit-etudiant');
    }

    #[On('export-ready')] 
    public function export($titres,$filename)
    {
                // 🔹 1. Récupération sécurisée des données
                $matricule = $this->newMatricule;
                $etudiants = etudiantModel::with('faculte')->where('matricule', $matricule)->get();
                
                $pdf = Pdf::loadView('tamplate.pdf.ficheInscriptionPostulant', [
                'etudiants' => $etudiants,
                'titre'=> $titres,
                'matricule'=>$matricule,
                'codeFac'=> $this->getnomFac($this->codeFac)
                ])->setOption('enable-local-file-access', true);
                
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

                $action ="Generation d'un document pdf";
                audit(Auth::user()->personnel->code, $action, $filename);
                $this->resetForm();

    }


    public function render()
    {
        return view('livewire.pages.etudiants.formulaire-etudiants');
    }
}
