<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class HomeControllerMy extends Controller
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

    public function show($userId = -1)
    {
        if (Auth::guest()){
            return redirect('/login');
        }
        else{
            if($userId == -1) $userId = Auth::id();
            return View::make('main')->with('userID', $userId);
        }
    }
}
