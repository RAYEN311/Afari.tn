<?php

namespace App\Http\Controllers;

use App\Models\afari_users;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Http\Request;

class afari_users_controller extends Controller
{
    //
    public function login(){
        return 'rayen ben brahim' ;
    }
    public function register(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'email' => 'required|email|max:100',
            'phone' => 'required|digits:8',
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
            $afari_user = afari_users::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'phone' => $request->phone ,
                'password' => bcrypt($request->password)  ,
            ]);
            if($afari_user){
               return response()->json([
                'status' => 200, 
                'message' => 'user created succesfully'
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
