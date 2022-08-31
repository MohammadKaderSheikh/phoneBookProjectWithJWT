<?php

namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use  App\Models\RegistrationModel;
class LoginController extends Controller
{

    public function onLogin(Request $request){
        $username= $request->input('username');
        $password= $request->input('password');
        $userCount= RegistrationModel::where(['username'=>$username,'password'=>$password])->count();
        if($userCount==1){
            $key = env('TOKEN_KEY');
            $payload = [
                'site' => 'http://demo.com',
                'user' => $username,
                'iat' => time(),
                'exp' => time()+4000 
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
            return response()->json(['token'=>$jwt,'status'=>"login succes"]);
        }else{
            return "wrong username or password ";
        }
    }
}
