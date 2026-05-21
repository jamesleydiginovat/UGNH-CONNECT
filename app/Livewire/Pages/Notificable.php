<?php

namespace App\Livewire\Pages;

use App\Models\auditsModel;
use App\Models\notificationModel;
use App\Models\personnelsModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notificable extends Component
{
    protected $listeners = [
        'refreshLogin' => '$refresh',
        'refreshLogOut' => '$refresh',
        'refreshTable'=>'$refresh',
    ];
    public function getNotificationProperty(){
        return notificationModel::where('user_id', Auth::user()->id)->latest()->get();
    }

    public function getCountNotificationProperty(){
        return notificationModel::where('user_id', Auth::user()->id)->count();
    }

    public function NomPersonnel($id){
        $codePersonnel = auditsModel::where('id',$id)->value('code');
        // return($codePersonnel);
        return personnelsModel::where('code',$codePersonnel )->first();
    }

    public function markAsSeen($Notifid){
        notificationModel::where('notification_id', $Notifid)
                           ->where('user_id', Auth::user()->id)
                           ->delete();
    }

    public function markAllAsSeen(){
        notificationModel::where('user_id', Auth::user()->id)->delete();
    }
    public function render()
    {
        return view('livewire.pages.notificable');
    }
}
