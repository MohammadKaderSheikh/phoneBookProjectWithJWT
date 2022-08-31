<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\RegistrationModel;
class RegistrationController extends Controller
{
    public function onRegister(Request $request){
       $first_name= $request->input('first_name');
       $last_name= $request->input('last_name');
       $city= $request->input('city');
       $username= $request->input('username');
       $password= $request->input('password');
       $gender = $request->input('gender');

      $userCount= RegistrationModel::where('username',$username)->count();
      if($userCount!=0){
        return "user alredy Exists";
      }else{
        $result = RegistrationModel::insert([
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'city'=>$city,
            'username'=>$username,
            'password'=>$password,
            'gender'=>$gender
        ]);
        if($result==true){
            return "resistration successfully done ";
        }else{
            return " rasistration faild try again ";
        }

      }

    }
}
