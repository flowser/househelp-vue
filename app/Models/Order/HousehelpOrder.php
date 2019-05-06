<?php

namespace App\Models\Order;

use App\Models\Order\Order;
use App\Models\househelp\househelp;
use App\Models\Client\Standard\Result;
use Illuminate\Database\Eloquent\Model;

class househelpOrder extends Model
{
    protected $table = 'househelp_order';
    protected $fillable = [
        'order_id',
        'househelp_id',
        'payment_confirmation',
        'name',
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
    ];

    protected $casts = [
        'payment_confirmation' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function househelp()
    {
        return $this->belongsTo(househelp::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }


}
