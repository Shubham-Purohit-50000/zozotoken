<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Hash;
use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (filled($user)) {
            $request->session()->put('user', $user);
            Auth::login($user);
            return redirect('/')->with('You have Successfully loggedin');
        }
        else {    
            return back()->withError('Oppes! You have entered invalid credentials');   
        }  
   
    }

    public function directLogin(Request $request){

        Log::info($request->all());

        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (filled($user)) {
            $request->session()->put('user', $user);
            return redirect('/')->with('You have Successfully loggedin');
        }
        else {    
            return back()->withError('Oppes! You have entered invalid credentials');   
        }  
    }

    public function login(){
        return view('login');
    }

    public function registeration(){
        return view('registeration');
    }

    public function manualLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user', $user);
            return redirect('/')->with('success','You have Successfully loggedin');
        }
  
        return redirect('/')->with('error','Invalid Credentials!');
    }

    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'password' => 'required|string|same:c_password|min:8',
            'c_password' => 'required',
        ]); 
           
        $data = $request->all();
        $user = $this->create($data);
        if($user){
            Auth::login($user);
            $request->session()->put('user', $user);
            return redirect('/')->with('success','User register successfully!');
        }
        return redirect('/')->with('error','Something wrong! please try again later.');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'username' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

}
