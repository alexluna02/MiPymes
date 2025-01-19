<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registrar(Request $request){
        $user = new User();

        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);

        $user->save();

        return redirect(route('login'));
    }
    public function login(Request $request){
        $credencials=["email"=>$request->email,
        "password"=> $request->password];

        $remember = ($request->has('remember'? true:false));

        if (Auth::attempt($credencials,$remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        } else {
            return redirect('login');
        }
        
        
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
