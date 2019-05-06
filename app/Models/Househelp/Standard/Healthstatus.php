<?php

namespace App\Models\Househelp\Standard;

use App\Models\Househelp\Househelp;
use Illuminate\Database\Eloquent\Model;

class Healthstatus extends Model
{
    protected $fillable = [
        'bureau_househelp_id',
        'status',
        'HIV_status',
        'other_chronics',
        'chronic_details',
        'allergy',
        'specify'
    ];

    public function househelp()
    {
        return $this->belongsTo(Househelp::class);
    }
}
