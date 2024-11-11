<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LogUserRequest;
use App\Http\Requests\registerRequest;

class UserController extends Controller
{   
    public function login(LogUserRequest $request){
        if(auth()->attempt($request->only(['email','password']))){
            $user = auth()->user();
            $token= $user->createToken("MA_CLE_SECRETE_VISIBLE_DANS_LE_BACKEND")->plainTextToken;
            return response()->json([
                'status_code'=>200,
                'status_message' => 'User connected',
                'data'=>$user,
                'token'=>$token
                ], 200);
        }else{
            return response()->json([
                'status_code'=>401,
                'status_message' => 'Invalid credentials'
                ], 401);
        }
    }
    public function register(registerRequest $request){
        try {
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password,[ 'rounds' => 12]);
            $user->save();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'User created successfully',
                'data'=>$user
            ],200);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
