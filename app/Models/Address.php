<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',  
        'city',
        'state',
        'zip_code',
        'country',
        'customer_id'
    ];

    public function customer()
    {
      return $this->belongsTo(Customer::class,'customer_id','id' );
    }


}
