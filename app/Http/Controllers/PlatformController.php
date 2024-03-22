<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatformController extends Controller
{
    public function dashboard()
    {
//        Auth::logout();
        return view('platforms.dashboard');
    }
}
