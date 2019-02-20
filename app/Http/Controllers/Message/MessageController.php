<?php

namespace App\Http\Controllers\Message;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class MessageController extends Controller
{



    public function sendMessage(){
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        return response()->json($response); 
    }
}
