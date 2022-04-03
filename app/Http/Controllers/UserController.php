<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index()
    {
       return view('User.index');
    }


    public function passwordResetCustomer(Request $request){
      try{
        $userId = Auth::id();  
        $user = User::where('id',$userId)->first();
        
        $user->password = Hash::make($request->password);
        $user->save();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error change password'
            ], 200);
        }

        return  response()->json([
            'status' => true,
            'message' => 'Your password was successfully changed',       
        ], 200);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'There was an error resetting the password'
      ]); 
     
      }

    }  
    
}
