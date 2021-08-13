<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;

class NotificationController extends Controller
{
    public function notifications()
    {
        return auth()->user()->unreadNotifications->toJson();
    }

    public function mark_as_read($id)
    {
        $notification = auth()->user()->notifications()->where('id',$id)->first();
        if ($notification)
        {
            $notification->markAsRead();
            return response()->json([
                'status' => 'success',
                'data'=> $notification->data
            ]);
        }
        else
            return response()->json([
                'status' => 'error'
            ]);
    }
}

