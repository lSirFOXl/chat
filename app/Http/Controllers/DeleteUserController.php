<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Auth;


class DeleteUserController extends Controller {
    

    public function sendMessage(Request $request){
        
    }

    public function deleteUser($userId){
        if (Auth::guest() || Auth::user()['attributes']['privilege'] != 0){
            return redirect('/');
        }
        else{
            DB::table('messages')->where('sender', '=', $userId)->orwhere('recipient', '=', $userId)->delete();
            DB::table('users')->where('id', '=',  $userId)->delete();
            return redirect('/');
        }
    }
}