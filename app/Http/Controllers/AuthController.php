<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken("Saad");
        return [ 'user' => $user,'token' => $token->plainTextToken];

    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string|exists:users,email',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $tokeen = $user->createToken($user->name)->plainTextToken;
        return [
            'user' => $user,
            'token' => $tokeen
        ];
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }

    public function user(Request $request){
        return $request->user();
    }
}
