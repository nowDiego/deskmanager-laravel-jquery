<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'ssn', 
        'phone'     
    ];

    public function user()
{
    return $this->morphOne(User::class, 'userable');
}

public function called()
{
  return $this->hasMany(Called::class,'customer_id','id')->with('status');
}

public function address()
{
  return $this->hasMany(Address::class,'customer_id','id');
}

}
