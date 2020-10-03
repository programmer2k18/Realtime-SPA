<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        return [
            'read'=>auth()->user()->readNotifications,
            'unread'=>auth()->user()->unreadNotifications
        ];
    }

    public function markAsRead(Request $request){
        auth()->user()->unreadNotifications->where('id',$request->id)->markAsRead();
        return response('Marked as read',200);
    }
}
