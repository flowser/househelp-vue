<?php

namespace App\Models\Standard;


use App\Models\Bureau\Bureau;
use App\Models\Client\Client;
use App\Models\Standard\Ward;
use App\Models\Standard\Country;
use App\Models\Househelp\Househelp;
use App\Models\Bureau\BureauEmployee;
use App\Models\Standard\Constituency;
use App\Models\Househelp\HousehelpKin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;
use App\Models\Organisation\OrganisationEmployee;

class County extends Model
{
    protected $fillable = [
        'name',
        'country_id',
    ];

    public function countries()
    {
        return $this->BelongsTo(Country::class);
    }
    public function constituencies()
    {
        return $this->BelongsTo(Constituency::class);
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
