<?php

namespace App\Models\Standard;


use App\Models\Bureau\Bureau;
use App\Models\Client\Client;
use App\Models\Standard\Town;
use App\Models\Standard\County;
use App\Models\Househelp\Househelp;
use App\Models\Bureau\BureauEmployee;
use App\Models\Standard\Constituency;
use App\Models\Househelp\HousehelpKin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;
use App\Models\Organisation\OrganisationEmployee;

class Country extends Model
{
    protected $fillable = [
        'name',
        'sortname',
    ];

    public function counties()
    {
        return $this->hasMany(County::class);
    }
    public function constituencies()
    {
        return $this->hasManyThrough(Constituency::class, County::class);
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
