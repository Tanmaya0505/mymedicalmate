<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function assistantnotification(Request $request){
        Notification::where('to_user_type','assistant')->orderBy('id','DESC')->update(['is_readed'=>1]);
        
        $list_notify = Notification::where('to_user_type','assistant')->orderBy('id','DESC')->get();


        return view('notifications.medical-mate',compact('list_notify'));

    }
    public function vendornotification(Request $request){

        Notification::where('to_user_type','vendor')->orderBy('id','DESC')->update(['is_readed'=>1]);
        
        $list_notify = Notification::where('to_user_type','vendor')->orderBy('id','DESC')->get();


        return view('notifications.vendor',compact('list_notify'));
    }
    public function usernotification(Request $request){
        Notification::where('to_user_type','user')->orderBy('id','DESC')->update(['is_readed'=>1]);
        
        $list_notify = Notification::where('to_user_type','user')->orderBy('id','DESC')->get();


        return view('notifications.user',compact('list_notify'));

    }
    public function deliveryboynotification(Request $request){
        Notification::where('to_user_type','delivery-boy')->orderBy('id','DESC')->update(['is_readed'=>1]);
        
        $list_notify = Notification::where('to_user_type','delivery-boy')->orderBy('id','DESC')->get();


        return view('notifications.delivery-boy',compact('list_notify'));

    }
}
