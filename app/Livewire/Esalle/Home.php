<?php

namespace App\Livewire\Esalle;

use App\Models\annnee_accademiqueModel;
use App\Models\auditsModel;
use App\Models\coursModel;
use App\Models\devoirModel;
use App\Models\document_tb_esalleModel;
use App\Models\documentsModel;
use App\Models\etudianFaculteModel;
use App\Models\etudiant_password;
use App\Models\etudiantModel;
use App\Models\faculteModel;
use App\Models\notificationModel;
use App\Models\permissionModel;
use App\Models\professeurModel;
use App\Models\remiseDevoirModel;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
   {   
     use WithFileUploads; 

    public function anneeAccademiqueActive(){
        return annnee_accademiqueModel::where('active', true)->first();
    }


    public function getListeDevoirProperty(){
        return devoirModel::with('coursRelation')->where('anneAcademique', annnee_accademiqueModel::where('active',true)->first()->libelle)
                            ->where('codeFac', session('user_codeFac'))
                            ->where('niveau',session('user_niveau'))->latest()->get();
    }

    // ListeDevoirProf

    public function getListeDevoirProfProperty(){
        return devoirModel::with('coursRelation')->where('anneAcademique', annnee_accademiqueModel::where('active',true)->first()->libelle)
                            ->where('codeFac', $this->codeFac)
                            ->where('niveau',$this->niveau)->latest()->get();
    }


    public function nombreEtudiant(){
        return etudiantModel::with('faculte')
                            ->where('status', 'Etudiant')
                            ->where('niveau', session('user_niveau'))
                            ->whereHas('faculte', function ($query) {
                                $query->where('codeFac', session('user_codeFac'));
                            })
                            ->count();
    }


    public function nombreEtudiantProf(){
    return etudiantModel::with('faculte')
                        ->where('status', 'Etudiant')
                        ->where('niveau', $this->niveau)
                        ->whereHas('faculte', function ($query) {
                            $query->where('codeFac', $this->codeFac);
                        })
                        ->count();
    }

    public function nombreEtudiantRemttreDevoir($code){
        return remiseDevoirModel::where('codeDevoir', $code)
                                  ->count('matriculeEtudiant');
    }


    public function isSecure(){
        return etudiant_password::where('matricule', session('user_code'))
                                  ->exists();
    }


    public function getListeSalleProfProperty(){
       return coursModel::where('codeProf', session('user_code'))
                        // ->where('session', session('user_code'))
                        ->select('codeFac', 'niveau')
                        ->distinct()
                        ->get();
    }

    public function nomFac($codeFac){
        return faculteModel::where('codeFac', $codeFac)->value('nom');
    }

    public $password;
    public function savePassword(){

        $this->validate([
            'password'=>'required|min:8'
        ]);

        etudiant_password::create([
            'matricule'=>session('user_code'),
            'password'=> $this->password
        ]);

        session()->flash('success', '✅ Espace  securiser avec succès.');
    }

    public $codeDevoir;
    public $pdf;

    public function RemiseDevoirSelect($codeDevoir){
        $this->codeDevoir=$codeDevoir;
    }

    public function deleteDevoir($code){
        // récupérer toutes les remises
        $remises = remiseDevoirModel::where('codeDevoir', $code)->get();
        $devoir = devoirModel::where('code', $code)->value('pdf');
        // supprimer les fichiers
        foreach ($remises as $remise) {

            if ($remise->pdf && Storage::exists($remise->pdf)) {

                Storage::delete($remise->pdf);

            }
        }

        if ($devoir && Storage::exists($devoir)) {

            Storage::delete($devoir);

        }

        devoirModel::where('code', $code)->delete();
        remiseDevoirModel::where('codeDevoir', $code)->delete();
    }

    public function deleteDocument($id){
        // récupérer toutes les remises
        $document = document_tb_esalleModel::where('id', $id)->value('pdf');
        // supprimer les fichiers
        if ($document && Storage::exists($document)) {

            Storage::delete($document);

        }

        document_tb_esalleModel::find($id)->delete();
    }
    // deleteDocument


    public $codeFac=null;
    public $niveau =null;

    public function setValue($codeFac,$niveau){
        $this->codeFac = $codeFac;
        $this->niveau=$niveau;
    }


    public function saveDevoir()
    {
        $matricule = session('user_code');

        // 🔍 Vérifier si déjà remis
        $exists = remiseDevoirModel::where('matriculeEtudiant', $matricule)
            ->where('codeDevoir', $this->codeDevoir)
            ->exists();

        if ($exists) {
            session()->flash('error', '❌ Vous avez déjà remis ce devoir.');
            return;
        }

        $fileName = null;

        // 📁 Upload fichier
        if ($this->pdf) {
            $fileName = $matricule . '_' . time() . '_' . $this->pdf->getClientOriginalName();
            $this->pdf->storeAs('remiseDevoirEtudiant', $fileName, 'public');
        }

        // 💾 Enregistrement
        remiseDevoirModel::create([
            'matriculeEtudiant' => $matricule,
            'codeDevoir'        => $this->codeDevoir,
            'pdf'               => $fileName,
            'dateRemise'        => now()
        ]);

        session()->flash('success', '✅ Devoir remis avec succès.');

        $this->reset();
    }


    public function isRemis($codeDevoir){
        return remiseDevoirModel::where('codeDevoir', $codeDevoir)
                                            ->where('matriculeEtudiant',session('user_code'))
                                            ->exists();

    }

    public function nomProf($codeProf)
    {
        $prof = professeurModel::where('codeProf', $codeProf)->first();

        return trim(optional($prof)->nom . ' ' . optional($prof)->prenom) ?: 'Professeur inconnu';
    }

    public function getListeDocumentProperty(){
        return document_tb_esalleModel::with('coursRelation')->where('anneAcademique', annnee_accademiqueModel::where('active',true)->first()->libelle)
                            ->where('codeFac', session('user_codeFac'))
                            ->where('niveau',session('user_niveau'))
                            ->get()
                            ->groupBy('session');
    }
    
    public function downloadDevoir($id)
    {
        $devoir = devoirModel::findOrFail($id);

        $path = storage_path('app/public/devoirs/' . $devoir->pdf);

        return response()->download($path);
    }


    public function downloadDocument($id)
    {
        $document = document_tb_esalleModel::findOrFail($id);

        $path = storage_path('app/public/documentCours/' . $document->pdf);

        return response()->download($path);
    }




    public function downloadDevoirRemis($id)
    {
        $document = remiseDevoirModel::findOrFail($id);

        $path = storage_path('app/public/remiseDevoirEtudiant/' . $document->pdf);

        return response()->download($path);
    }


    // 



    protected $listeners = [
        'refreshLogin' => '$refresh',
        'refreshLogOut' => '$refresh',
        'refreshTable'=>'$refresh',
    ];

    public function getNotificationProperty(){
        return notificationModel::where('user_id', session('user_code'))->latest()->limit(1)->get();
    }

    // public function getCountNotificationProperty(){
    //     return notificationModel::where('user_id', Auth::user()->id)->count();
    // }

    // public function markAsSeen($Notifid){
    //     notificationModel::where('notification_id', $Notifid)
    //                        ->where('user_id', Auth::user()->id)
    //                        ->delete();
    // }

    public function markAllAsSeen(){
        notificationModel::where('user_id', session('user_code'))->delete();
    }


    public $codeDevoirProf;
    public function selectDevoir($codeDevoir){
        $this->codeDevoirProf=$codeDevoir;
    }


    public function getEtudiantRemisDevoirProperty(){
        return remiseDevoirModel::with('etudiant')->where('codeDevoir', $this->codeDevoirProf)->get();
    }

    // ListeDocumentProf

    public function getListeDocumentProfProperty(){
    return document_tb_esalleModel::with('coursRelation')->where('anneAcademique', annnee_accademiqueModel::where('active',true)->first()->libelle)
                        ->where('codeFac', $this->codeFac)
                        ->where('niveau',$this->niveau)
                        ->get()
                        ->groupBy('session');
    }



    public function render()
    {
        return view('livewire.esalle.home');
    }
}
