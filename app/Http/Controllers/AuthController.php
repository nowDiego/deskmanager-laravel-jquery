<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
 
 public function index(){
   return view('Auth.login');
 } 


public function login(Request $request){
  
try{
        $user = User::where('name', $request->name)->with(['Role','Userable'])->first();              
           
       
          if (!$user) {
            return
            response()->json([
                'status'=>false,
                'message'=>'Invalid login'
            ]);
       }
    
       if (! Hash::check($request->password, $user->password)) {
        return
        response()->json([
            'status'=>false,
            'message'=>'Invalid login'
        ]); 
       
    }
    
      $auth = Auth::login($user);    

      $data = $user->only(['role','userable']);

  
      return
      response()->json([
          'status'=>true,
          'message'=>'Success login',
          'data'=>$data         
      ]); 
    
    }catch (Throwable $e) {

      return 
      response()->json([
        'status'=>false,
        'message'=>'An error occurred while trying to access the system'
    ]); 
   
    }

    }
    
      
   
    public function logout(){
      Auth::logout();      
      return view('Auth.login');
    } 

    
}
