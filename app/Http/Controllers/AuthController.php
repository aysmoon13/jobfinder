<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;                                                                                       
use Illuminate\Support\Facades\Auth;                                                                               
use Illuminate\Support\Facades\Hash;                                                                               
use App\Models\User; 

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    //check if the pass and email are correct
     public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            return redirect()->intended(route('jobs.index'));
        }

        return back()
            ->withErrors([
                'email' => 'Credentials not found.'
            ])
            ->withInput();
    }                                                                                                             
                                                                                                                        
       // Show Register Form                                                                                          
       public function showRegister()                                                                                 
       {                                                                                                              
           return view('auth.register');                                                                              
       }                                                                                                              
                                                                                                                      
       // Process Register                                                                                            
       public function register(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'role' => 'required|in:employer,job_seeker',
                
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>$request->password,
                'role' => $request->role,
            ]);

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('jobs.index');
        }                                                                                                            
                                                                                                                      
       // Logout                                                                                                      
       public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home');
        }                            
}
