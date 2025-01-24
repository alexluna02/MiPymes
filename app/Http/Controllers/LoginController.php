<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    public function registrar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        $user->assignRole($request['role']);
        $user->save();
        #$token = JWTAuth::fromUser($user);
        return redirect(route('login'));
    }
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $remember = ($request->has('remember' ? true : false));

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        } else {
            return redirect('login');
        }
        /*  if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return redirect(route('producto.index'));*/
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
        #return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = JWTAuth::refresh();
        return response()->json(['token' => $token]);
    }

    public function userProfile()
    {
        return response()->json(Auth::user());
    }

    public function registro()
    {
        $roles = Role::all();
        return view('registro', compact('roles'));
    }
}
