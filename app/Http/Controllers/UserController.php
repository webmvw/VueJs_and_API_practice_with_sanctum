<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function login(Request $request){
    	$user = User::where('email', $request->email)->first();
    	if(!$user || !Hash::check($request->password, $user->password)){
    		return response([
    			'message'=>['not a valid user']
    		],404);
    	}else{
    		$token = $user->createToken('my-app-token')->plainTextToken;
    		$response = [
    			'user'=>$user,
    			'token'=>$token
    		];
    		return response($response, 201);
    	}
    }
}
