<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supports')->insert(
            [
                'id' => 1,  
                'registration' => 'aB2112Desk',       
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
       
        DB::table('users')->insert(
            [
                'id' => 1,  
                'name' => 'support',  
                'email' => 'support@gmail.com', 
                'password' => Hash::make('system') ,
                'role_id'=>1,
                'userable_type'=>'App\Models\Support',
                'userable_id'=>1,              
                              
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }
}
