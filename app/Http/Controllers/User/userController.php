<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function dashboard(){
        return view('user.dashboard');
    }
}
