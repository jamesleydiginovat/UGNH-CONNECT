<?php

namespace App\Livewire\Pages;

use App\Events\updatedTable;
use App\Models\faculteModel;
use App\Models\facultes_prices;
use App\Models\notificationModel;
use App\Models\utilisateurModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TarifFaculte extends Component
{
    public $showModal = false;
    public $idTarif;
    public $codeFac;
    public $niveau;
    public $session;
    public $premierVersement;
    public $deuxiemeVersement;
    public $troisiemeVersement;
    public $prixTotal;


    public function editTarif($id)
    {
        $tarif = facultes_prices::findOrFail($id);

        $this->idTarif = $tarif->id;
        $this->codeFac = $tarif->codeFac;
        $this->niveau = $tarif->niveau;
        $this->session = $tarif->session;

        $this->premierVersement = $tarif->premierVersement;
        $this->deuxiemeVersement = $tarif->deuxiemeVersement;
        $this->troisiemeVersement = $tarif->troisiemeVersement;
        $this->prixTotal = $tarif->prixTotal;

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function updateTarif()
    {
        facultes_prices::find($this->idTarif)->update([
            'premierVersement' => $this->premierVersement,
            'deuxiemeVersement' => $this->deuxiemeVersement,
            'troisiemeVersement' => $this->troisiemeVersement,
            'prixTotal' => $this->prixTotal,
        ]);

        $this->showModal = false;

            broadcast(new updatedTable(''));
            $action ="Modification d'un prix d'une faculte";
            $audit = audit(Auth::user()->personnel->code, $action, $this->codeFac);

            //NOTIFICATION 
            $user =  utilisateurModel::with('roles')->get();
            $message = "modification d'un prix d'une faculte (".$this->codeFac.") dans le système.";

            foreach($user as $u){
                if(($u->roles->first()->nom ?? '')=="Administrateur" || ($u->roles->first()->nom ?? '')=="Secrétaire générale" || ($u->roles->first()->nom ?? '')=="Comptable"){

                    notificationModel::create([
                    'notification_id'=> $audit->id,
                    'user_id'=>$u->id,
                    'message'=>$message
                    ]);
                }
                
            }
            //FIN NOTIFICATION

        session()->flash('success', 'Tarif modifié avec succès.');
    }
    public function getTarifFaculteProperty(){
        return facultes_prices::all();
    }

    public function nomFac($codeFac){
        return faculteModel::where('codeFac', $codeFac)->value('nom');
    }
    public function render()
    {
        return view('livewire.pages.tarif-faculte');
    }
}
