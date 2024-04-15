<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;

class userController extends Controller
{
    //
    public function dashboard(){
        return view('user.dashboard');
    }

    public function sebayatregister(){

        $userid = Auth::user()->userid;
        $user = DB::table('users')
                ->where('users.userid', '=', $userid)
                ->first();      
        // $user = DB::table('users')
        //         ->join('bankdetails', 'users.userid', '=', 'bankdetails.userid')
        //         ->select('users.*', 'bankdetails.*')
        //         ->where('users.userid', '=', $userid)
        //         ->first();

            // dd($user);
        return view('user.sebayatregister', ['user' => $user]);
        // return view('user.sebayatregister');
    }
}
