<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalledStoreRequest;
use App\Http\Requests\DisableCalledRequest;
use Throwable;
use App\Models\User;
use App\Models\Called;
use App\Models\Category;
use App\Models\Customer;
use App\Models\StatusCalled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
     
        $called = Called::with('status','category','address')->paginate(10);     
       return  view('called.index',['called'=>$called]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the called'
      ]); 
     
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
       $user = Auth::user();  
       $categories = Category::get(); 
       $customer = Customer::with('address','called')->where('id',$user->userable_id)->first();

      return  view('called.register',['customer'=>$customer,'categories'=>$categories]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the called'
      ]); 
     
      }
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalledStoreRequest $request)
    {
       try{
        $user = Auth::user();
        $customer = Customer::where('id',$user->userable_id)->first();

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error registering Called'
           ], 200);
        }
 
       $protocol = 'called_'.rand(100000, 999999); 


       $called = new Called();
       $called->protocol = $protocol;
       $called->description = $request->description;
       $called->status_id = 1;
       $called->category_id = $request->category;
       $called->address_id = $request->address;
       $called->customer_id = $customer->id;
       
       $called->save();
       
       if (!$called) {
        return response()->json([
            'status' => false,
            'message' => 'There was an error registering Called'
       ], 200);
    }
    

    return
    response()->json([
        'status'=>true,
        'message'=>'registered successfully',                
    ]); 

} catch (Throwable $e) {
    return response()->json([
        'status' => false,
        'message' => 'There was an error registering Called'
   ], 200);

       }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Called  $called
     * @return \Illuminate\Http\Response
     */
    public function show(Called $called)
    {
               
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Called  $called
     * @return \Illuminate\Http\Response
     */
    public function edit(Called $called)
    {
        try{       
        if (!$called) {
            return response()->json([
                'status' => false,
                'message' => 'Called not found'
           ], 200);
        }

        return  view('called.edit',['called'=>$called]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the editing the called'
      ]); 
     
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Called  $called
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
    
    }

    public function disableCalled(DisableCalledRequest $request)
    {
        try{
        $called = Called::where('id',$request->called)->first();
        $called->status_id = 2;
        $called->observation = $request->observation;
        $called->save();

        if (!$called) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error disabled Called'
           ], 200);
        }
        
        
        return response()->json([
            'status'=>true,
            'message'=>'Disabled successfully',      
        ] 
        );
        
    }catch (Throwable $e) {

        return response()->json([
            'status' => false,
            'message' => 'There was an error disabled Called'
       ], 200);

    }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Called  $called
     * @return \Illuminate\Http\Response
     */
    public function destroy(Called $called)
    {
      try{        
         $called->delete();

        return response()->json([
            'success' => true,
            'message' => 'Called deleted successfully'
        ]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'There was an error removing the call'
      ]); 
     
      }
    }
}
