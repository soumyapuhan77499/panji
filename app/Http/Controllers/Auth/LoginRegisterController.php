<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Niti;
use Carbon\Carbon;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('livewire.signup');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request);
        // $request->validate([
        //     'first_name' => 'required|string|max:250',
        //     'last_name' => 'required|string|max:250',
        //     'email' => 'required|email|max:250|unique:users',
        //     'password' => 'required|min:8|confirmed'
        // ]);

        // $userdata = new User();
        // $userdata->userid = $request->userid;
        // $userdata->first_name = $request->first_name;
        // $userdata->last_name = $request->last_name;
        // $userdata->email = $request->email;
        // $userdata->password = Hash::make($request->password);
        // $userdata->save();
// dd($userdata);

        $user = new User();

        // Check if a name is provided in the request
        if ($request->has('first_name')) {
            $user->first_name = $request->first_name;
        }
        $user->userid = $request->userid;
        $user->name = $request->last_name;
        $user->last_name = $request->last_name;

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';

        // Save the user
        $user->save();

        // User::create([
        //     'userid' => $request->userid,
        //     'name' => $request->first_name.$request->last_name,
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'role'=> 'user'
        // ]);
        return redirect('/')->with('success', 'Registered successfully.');


        // $credentials = $request->only('email', 'password');
        // Auth::attempt($credentials);
        // $request->session()->regenerate();
        // return redirect()->route('index')
        // ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if(Auth::attempt($credentials))
    //     {
    //         $request->session()->regenerate();
    //         return redirect()->route('dashboard')
    //             ->withSuccess('You have successfully logged in!');
    //     }

    //     return back()->withErrors([
    //         'email' => 'Your provided credentials do not match in our records.',
    //     ])->onlyInput('email');

    // } 

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         $user = auth()->user();
    //         // Check if the user is active
    //         if ($user->status == 'active') {
    //             // Check if the user has the required role to login
    //                 return redirect()->intended('/admin/dashboard');
    //         } else {
    //             // User is not active, logout and redirect back with error message
    //             Auth::logout();
    //             return redirect()->back()->withErrors(['email' => 'Your account is not active. Please contact support.']);
    //         }
    //     }else{

    //     // Authentication failed...
    //     return redirect()->back()->withErrors(['email' => 'Invalid credentials.']); // Redirect back with error message
    // }
    // }
    
    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function dashboard()
    {
     
            $today = Carbon::today()->toDateString(); 

            $manage_nitis = Niti::where('status', 'active')
            ->whereDate('niti_date', $today) // Filter by today's date
            ->get();
        

            return view('dashboard',compact('manage_nitis'));
        
    } 

   
    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect()->route('login')
    //         ->withSuccess('You have logged out successfully!');;
    // }    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}