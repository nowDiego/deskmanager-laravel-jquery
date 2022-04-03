<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Called;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SupportStoreRequest;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $calleds = Called::with('status')->whereRelation('status','name','Aberto')->get();  

            $called = Called::with('status','category')->orderBy('id','desc')->limit(4)->get();
          
            return view('Dashboard.support',['called'=>$called->reverse(),'count'=>$calleds->count()]);
       
        }catch (Throwable $e) {      
            return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the Support'
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupportStoreRequest $request)
    {
        // try{

        $suport = new Support();
        $suport->registration = $request->registration;
        $suport->save();

        if (!$suport) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error registering Support'
           ], 200);
        }

        $user =  $suport->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),           
            'role_id' => 1
        ]);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error registering the support user'
            ], 200);
        }

        return  response()->json([
            'status' => true,
            'message' => 'registered support',
            'data' => $suport,
        ], 200);

  
    // }catch (Throwable $e) {    
    //     return response()->json([
    //         'status' => false,
    //         'message' => 'There was an error registering the support'
    //     ], 200);
    // }
  
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        try{
        $support->delete();

        return response()->json([
            'status' => true,
            'message' => 'Support deleted successfully'
        ]);
        
    }catch (Throwable $e) {    
        return response()->json([
            'status' => false,
            'message' => 'There was an error removing support'
        ], 200);
    }
}

}
