<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;

class afari_users_controller extends Controller
{
    public function index(){
        $users = users::all();
        return response()->json([
            'status' => 200 ,
            'users' => $users ,
        ],200);
    }
    public function createToken(Request $request){
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token -> plainTextToken];
    }
    public function login(Request $request){
        
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            $authuser = Auth::user();
            $success['token'] = $authuser->createToken($request->email)->plainTextToken;
            $success['name'] = $authuser->name;
            $current_user = users::where('email' , $request->email)->first();
            $current_user->remember_token = null ;
            $current_user->save() ;
            return response()->json([
                'status' => 200,
                'name' => $success['name'],
                'token' => $success['token'],
                'message' => 'login passed succesfully'
            ],200);
        }
        else{
        return response()->json([
            'status' => 401,
            'message' => 'unauthenticated'
        ],401);
        }
    }
    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users|max:100',
            'phone' => 'required|unique:users|digits:8',
            'password' => 'required|string:',
        ]); 
        if($validate->fails()){
            return response()->json([
                'status' => 422 ,
                'message' => $validate->messages(),
            ], 422);
        }
        else
        {
            $afari_user = users::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'phone' => $request->phone ,
                'password' => bcrypt($request->password)  ,
            ]);
            if($afari_user){
               return response()->json([
                'status' => 200, 
                'message' => 'User created succesfully welcome to afari !!'
               ]);
            }
            else{
                return response()->json([
                 'status' => 500, 
                 'message' => 'server error please try again'
                ]);
            }
        }
    }
}
