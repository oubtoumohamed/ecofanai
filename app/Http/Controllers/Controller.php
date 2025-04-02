<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Notification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function shownotif($id){
        $notif = Notification::find($id);

        $notif->read_at = date('Y-m-d');
        $notif->save();

        //dd($notif);
        return redirect()->to($notif->link);

    }
}
