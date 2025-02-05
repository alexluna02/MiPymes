<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        if ($users->isEmpty()) {
            return response()->json(['message'=>'No hay registros'],404);
        }
        return response()->json($users,200);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json($user, 201);
    }
}
