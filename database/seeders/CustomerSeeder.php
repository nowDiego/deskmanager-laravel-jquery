<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert(
            [
                'id' => 2,  
                'ssn' => '2144112',     
                'phone' => '2124746589',    
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
       
        DB::table('users')->insert(
            [
                'id' => 2,  
                'name' => 'customer',  
                'email' => 'customer@gmail.com', 
                'password' => Hash::make('system') ,
                'role_id'=>2,
                'userable_type'=>'App\Models\Customer',
                'userable_id'=>2,             
                              
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );


        DB::table('addresses')->insert(
            [
                'id' => 2,  
                'street' => 'Av Copacabana',     
                'city' => 'Rio de Janeiro   ',  
                'state' => 'RJ',     
                'zip_code' => '11211',     
                'country' => 'Brazil',     
                'customer_id' => 2,     
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }
}
