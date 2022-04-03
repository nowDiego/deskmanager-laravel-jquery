<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Called;
use Illuminate\Http\Request;

class GeneratorPDF extends Controller
{
    public function generatorPdf($data){
       
        $date = null;

        switch ($data) {
            case 'day': $date = Carbon::now()->subDays(1);     break;  
            case 'week':  $date = Carbon::now()->subDays(7);   break;   
            case 'month':  $date = Carbon::now()->subDays(30); break;
            
            }
          
        $now = Carbon::now();                
        $called = Called::with('status','category')->whereBetween('created_at',[$date, $now])->get();
         
             
        $pdf = PDF::loadView('Template.pdf',['called'=>$called,'data'=>$date,'now'=>$now]); 
                    
        return $pdf->download('report.pdf');  
    

   }

}