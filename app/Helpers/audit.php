<?php

use App\Models\auditsModel;
use App\Models\notificationModel;

if (!function_exists('audit')) {

    function audit($code, $action, $record_code = null, $notificable=null , $adresse_ip =null)
    {
        return auditsModel::create([
            'code' => $code,
            'action' => $action,
            'record_code' => $record_code,
            'ip_adresse'=>$adresse_ip,
            'notificable'=>$notificable
        ]);
    }

}