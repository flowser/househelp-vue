<?php

namespace App\Models\Househelp\Standard;

use App\Models\Househelp\Househelp;
use Illuminate\Database\Eloquent\Model;

class Idstatus extends Model
{
    protected $fillable = [
        'status',
        'reason',
        'id_number',
        'ref_number',
        'id_photo_front',
        'id_photo_back',
        'waiting_card_photo',
        'bureau_househelp_id',
    ];

    public function househelp()
    {
        return $this->belongsTo(Househelp::class);
    }
}
