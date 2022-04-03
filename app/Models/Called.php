<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Called extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocol',   
        'description',
        'observation',
        'status_id',
        'category_id',
        'address_id',
        'customer_id'   
    ];

    public function status()
    {
      return $this->hasOne(StatusCalled::class,'id','status_id' );
    }

    public function category()
    {
      return $this->belongsTo(Category::class,'category_id','id');
    }

    public function address()
    {
      return $this->hasOne(Address::class,'id','address_id');
    }

    public function customer()
    {
      return $this->belongsTo(Customer::class,'customer_id','id');
    }


}
