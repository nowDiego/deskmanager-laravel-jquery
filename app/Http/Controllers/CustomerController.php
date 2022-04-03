<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerAddressRequest;
use App\Http\Requests\CustomerStoreRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Dashboard.customer');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Customer.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        try{
        $customer = new Customer();
        $customer->ssn = $request->ssn;
        $customer->phone = $request->phone;
        $customer->save();
        

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error registering Customer'
           ], 200);
        }

        $address =  $customer->address()->create([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,           
            'zip_code' =>  $request->zip_code, 
            'country' =>  $request->country,           
        ]);

        if (!$address) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error registering the customer address'
            ], 200);
        }


        $user =  $customer->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),           
            'role_id' => 2
        ]);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'There was an error registering the customer user'
            ], 200);
        }

        return  response()->json([
            'status' => true,
            'message' => 'registered customer',
            'data' => $customer,
        ], 200);


    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'There was an error registering Customer'
      ]); 
     
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try{

        $customer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully'
        ]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'There was an error removing customer'
      ]); 
     
      }


    }


    public function profile(Request $request){
try{
        $user = Auth::user();      
       $customer = Customer::with('address','user')->where('id',$user->userable_id)->first();

        return view('Customer.profile',['customer'=>$customer]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the profile'
      ]); 
     
      }
    }


    public function address(CustomerAddressRequest $request){

        try{
        $user = Auth::user();      
       $customer = Customer::where('id',$user->userable_id)->first();

       $address =  $customer->address()->create([
        'street' => $request->street,
        'city' => $request->city,
        'state' => $request->state,           
        'zip_code' =>  $request->zip_code, 
        'country' =>  $request->country,           
    ]);

    if (!$address) {
        return response()->json([
            'status' => false,
            'message' => 'There was an error registering the customer address'
        ], 200);
    }

    return  response()->json([
        'status' => true,
        'message' => 'address registered successfully',       
    ], 200);
    
}catch (Throwable $e) {
    return response()->json([
        'status' => false,
        'message' => 'There was an error registering the customer address'
    ], 200);
    }
       

    }

    public function destroyAddress($address){
try{
        $user = Auth::user();      
        $customer = Customer::where('id',$user->userable_id)->first();

        $customer->address()->where('id',$address)->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Address deleted successfully'
        ]);

    }catch (Throwable $e) {
        return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the system'
      ]); 
     
      }

    }
    
}
