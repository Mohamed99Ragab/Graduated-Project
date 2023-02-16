<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsResource;
use App\Http\Traits\HttpResponseJson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    use HttpResponseJson;


    public function history_of_notidfication(){


        $user = User::find(Auth::guard('api')->id());

        $notifications = [];
        foreach ($user->unreadNotifications as $notification) {


            $notifications [] =$notification;


        }

        $notifications = NotificationsResource::collection($notifications);


        if (isset($notifications) && $notifications->count() >0){

            return $this->responseJson($notifications,'null',true);

        }

        return $this->responseJson(null,'لا توجد اشعارات جديدة حتى الان',true);

    }


    public function mark_all_notificatis_as_read(){

        $user = User::find(Auth::guard('api')->id());

        $user->unreadNotifications->markAsRead();

        return $this->responseJson(null,'تم إزلة الاشعارات من السجل بنجاح',true);
    }


}
