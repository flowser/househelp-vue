<?php

namespace App\Models\Order;

use App\Models\Client\Client;
use App\Models\househelp\househelp;
use App\Models\Order\househelpOrder;
use App\Models\Client\Standard\Result;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'total',
        'payment_method',
        'transaction_code',
        'transaction_image'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

     //has many
     public function househelps()
     {
         return $this->belongsToMany(househelp::class,'househelp_order')
                     ->withPivot(
                        'payment_confirmation',
                        'name',
                        'age',
                        'gender',
                        'education',
                        'experience',
                        'maritalstatus',
                        'tribe',
                        'skill',
                        'operation',
                        'duration',
                        'englishstatus',
                        'religion',
                        'kid',
                        'image',
                        'qty',
                        'fee'
                     )
                     ->withTimestamps();
     }
     public function results()
     {
         return $this->hasManyThrough(Result::class, househelpOrder::class);
     }
}
