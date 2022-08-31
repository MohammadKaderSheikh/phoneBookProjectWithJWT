<?php

namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use  App\Models\PhoneBookModel;
class PhonebookController extends Controller
{
   public function onInsert(Request $request){
         $token = $request->input('access_token'); 
         $key = env('TOKEN_KEY');
         $decoded = JWT::decode($token, new Key($key, 'HS256'));
         $decoded_array=(array)$decoded;

          $user= $decoded_array['user'];
          $one = $request->input('phone_number_one');
          $two = $request->input('phone_number_two');
          $name= $request->input('name');
          $email =$request->input('email');
          $userCount= PhoneBookModel::where('phone_number_one',$one)->count();

          if($userCount!=0){
            return "Phone number alredy exist";
          }else{
                $result = PhoneBookModel::insert([
                  'username'=> $user,
                  'phone_number_one'=>$one,
                  'phone_number_two'=> $two,
                  'name'=>$name,
                  'email'=> $email,
              ]);
              if($result==true){
                return "save succes ";
              }
              else{
                return "failed try again ";
              }  
    }
    }
   public function onSelect(Request $request){
         $token = $request->input('access_token');
         $key = env('TOKEN_KEY');
         $decoded = JWT::decode($token, new Key($key, 'HS256'));
         $decoded_array=(array)$decoded;
         $user= $decoded_array['user'];

         $result= PhoneBookModel::where('username', $user)->get();
         return response()->json($result);

    }

  public  function onDelete(Request $request){
              $email = $request->input('email');
              $token = $request->input('access_token');
              $key = env('TOKEN_KEY');
              $decoded = JWT::decode($token, new Key($key, 'HS256'));
              $decoded_array=(array)$decoded;
              $user= $decoded_array['user'];
              $result= PhoneBookModel::where(['username'=> $user,'email'=>$email])->delete();
              if($result==true){
                 return "delete success full ";
              }else{
                return "delete failed try again";
              }

    }
}
