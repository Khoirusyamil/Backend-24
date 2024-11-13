<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register (Request $request){
        $userData= [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ];
        $user = user::create($userData);
        $data = ['message'=> 'Berhasil membuat user'];

        return response()->json($data, 200);
    }

    public function login (Request $request)
    {
        $userData =[
            'email'=>$request->email,
            'password'=>$request->password];

        if (Auth::attempt($userData)){
            $token = Auth::user()->createToken('auth_token');
            $data = ['message'=> 'Berhasil login',
                     'token'=>$token->plainTextToken];

        return response()->json($data,200);
        }
        else{
            $data = ['message'=> 'Berhasil login'];

            return response()->json($data,401);
        }
    }
}