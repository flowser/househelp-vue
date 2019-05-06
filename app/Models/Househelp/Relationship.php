<?php

namespace App\Models\Househelp\Standard;


use App\Models\Househelp\HousehelpKin;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $fillable = [
        'name',
    ];

    public function househelpkins()
    {
        return $this->hasMany(HousehelpKin::class);
    }
}
