<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\Called;
use Illuminate\Http\Request;

class GeneratorGraph extends Controller
{
    public function generatorGraph()
    {
 
        try{
        
        $labels = $this->labels();
        $data = $this->Data();
     
       
        return response()->json([
            'status'=>true,
            'labels'=>$labels,           
            'data'=>$data,
        ]);

    }catch (Throwable $e) {

        return 
        response()->json([
          'status'=>false,
          'message'=>'An error occurred while trying to access the system'
      ]); 
     
      }
        

    }


    public function Labels(){

        $label['1'] = Carbon::now()->subMonthNoOverflow(3)->format('M');   
        $label['2'] = Carbon::now()->subMonthNoOverflow(2)->format('M');
        $label['3'] = Carbon::now()->subMonthNoOverflow(1)->format('M');
        $label['4'] = Carbon::now()->format('M');

        return $label ;
    }

public function Data(){
 
    $month['1'] = Carbon::now()->subMonthNoOverflow(3)->format('m');    
    $month['2'] = Carbon::now()->subMonthNoOverflow(2)->format('m');
    $month['3'] = Carbon::now()->subMonthNoOverflow(1)->format('m');
    $month['4'] = Carbon::now()->format('m');

    $data['1'] = Called::with('status','category')->whereMonth('created_at',$month['1'])->get()->count();
    $data['2'] = Called::with('status','category')->whereMonth('created_at',$month['2'])->get()->count();
    $data['3'] = Called::with('status','category')->whereMonth('created_at',$month['3'])->get()->count();
    $data['4'] = Called::with('status','category')->whereMonth('created_at',$month['4'])->get()->count();

    return $data;

}

}
