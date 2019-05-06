<?php

namespace App\Models\Standard;


use App\Models\Client\Client;
use App\Models\Househelp\Househelp;
use App\Models\Bureau\BureauEmployee;
use App\Models\Househelp\HousehelpKin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\OrganisationEmployee;

class Gender extends Model
{
    protected $fillable = [
        'name',        
    ];

   
    public function organisationemployees()
    {
        return $this->hasMany(OrganisationEmployee::class);
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
