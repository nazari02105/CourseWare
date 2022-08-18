<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function addNotification ($id, $type, $message){
        DB::table("notifications")->insert(["user_id"=>$id, "type"=>$type, "message"=>$message,
            "created_at"=>Carbon::now(), "time"=>time()
        ]);
    }

    public function deleteNotification ($type, $id){
        DB::table("notifications")->where(["id"=>$id])->update(["deleted_at"=>Carbon::now()]);
        return redirect("/$type/dashboard");
    }
}
