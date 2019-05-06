<?php

namespace App\Models\Standard;


use App\Models\Bureau\Bureau;
use App\Models\Client\Client;
use App\Models\Standard\County;
use App\Models\Househelp\Househelp;
use App\Models\Bureau\BureauEmployee;
use App\Models\Househelp\HousehelpKin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;
use App\Models\Organisation\OrganisationEmployee;

class Constituency extends Model
{

    protected $fillable = [
        'name',
        'county_id',
    ];

    public function county()
    {
        return $this->BelongsTo(County::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    public function organisations()
    {
        return $this->hasMany(Organisation::class);
    }
    public function organisationemployees()
    {
        return $this->hasMany(OrganisationEmployee::class);
    }
    public function bureaus()
    {
        return $this->hasMany(Bureau::class);
    }
    public function bureausemployees()
    {
        return $this->hasMany(BureauEmployee::class);
    }
    public function househelps()
    {
        return $this->hasMany(Househelp::class);
    }
    public function househelpkins()
    {
        return $this->hasMany(HousehelpKin::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
