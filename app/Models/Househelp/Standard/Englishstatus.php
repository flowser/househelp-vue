<?php

namespace App\Models\Househelp\Standard;

use App\Models\Househelp\Househelp;
use Illuminate\Database\Eloquent\Model;

class Englishstatus extends Model
{
    protected $fillable = [
        'name',
    ];

    public function househelps()
    {
        return $this->hasMany(Househelp::class);
    }
}
