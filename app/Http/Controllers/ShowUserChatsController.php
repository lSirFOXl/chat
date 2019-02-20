<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class ShowUserChatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        
    }

    public function show($userId)
    {
        if (Auth::guest() || Auth::user()['attributes']['privilege'] != 0){
            return redirect('/');
        }
        else{
            return View::make('main')->with('userID', $userId)->with('isAdminShow', true);
        }
    }
}
