<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class NotificationController extends Controller
{    
    public function tome()
    {
        $notifications = DB::table('notifications')->where('user_id',auth()->user()->id)
                        ->whereNull('read_at')
                        ->whereNull('deleted_at')
                        ->get();

        return response()->json( $notifications );
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $notification = Notification::findFail($id);

        return response()->json( $notification );
    }

    public function update(Request $request, $id)
    {
       //
    }

    public function readNotifs(Request $request, $id)
    {

        $notification = Notification::findFail($id);

        //if($notification && $notification->id){

            $notification->etat = "read";
            $notification->read_at = date("Y-m-d H:i:s");
            $notification->save();

        //}

        return response()->json([
            //'success' => __('global.edit_succees'),
            //'data' => $notification
        ]);

    }

    public function destroy($id)
    {
        $msg = 'delete_error';
        $flash_type = 'error';
        $notification = Notification::findFail($id);

        if( $notification->softdelete() ){
            $flash_type = 'success';
            $msg = 'delete_succees';
        }

        return response()->json([
            $flash_type => __('global.'.$msg),
        ]);
    }
}
