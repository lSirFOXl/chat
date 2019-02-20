<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;
use \App\User;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function show($userIDOther, $userID = -1)
    {
        if (Auth::guest() || ($userID != Auth::id() && Auth::user()['attributes']['privilege'] != 0 && $userID != -1) || User::findOrFail($userIDOther)['attributes']['privilege'] == 0){
            return redirect('/');
        }
        else{
            if($userID != -1 && Auth::user()['attributes']['privilege'] == 0){
                return View::make('chat')->with('userIDOther', $userIDOther)->with('userID', $userID)->with('isAdminShow', true);
            }
            if($userID == -1) $userID = Auth::id();
            return View::make('chat')->with('userIDOther', $userIDOther)->with('userID', $userID);
        }
    }
}
