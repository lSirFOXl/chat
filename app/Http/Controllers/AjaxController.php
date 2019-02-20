<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;


class AjaxController extends Controller {
    

   public function sendMessage(Request $request){
        
        if($request->message != ""){
            DB::table('messages')->insert(
                ['sender' => $request->sender, 'recipient' => $request->receiver, 'message' => $request->message, 'checked' => 0, 'created_at' => date("Y-m-d H:i:s")]
            );
            $response = array(
                'status' => 'ok',
                'msg' => $request->message,
            );
        }
        else{
            $response = array(
                'status' => 'nok',
                'msg' => $request->message,
            );
        }

        return response()->json($response); 
   }
}