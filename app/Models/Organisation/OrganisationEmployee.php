<?php

namespace App\Models\Organisation;


use App\Models\Bureau\Bureau;
use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use App\Models\Standard\Gender;
use App\Models\Standard\Country;
use App\Models\Standard\Position;
use App\Models\Househelp\Househelp;
use App\Models\Standard\Constituency;
use App\Models\Organisation\Organisation;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrganisationEmployee extends Pivot
{
    protected $fillable = [
        'user_id',
        'organisation_id',
        'position_id',
        'photo',
        'active',
        'id_no',
        'id_photo_front',
        'id_photo_back',
        'about_me',
        'phone',
        'landline',
        'address',
        'country_id',
        'county_id',
        'constituency_id',
        'ward_id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    //belongs to
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function constituency()
    {
        return $this->belongsTo(Constituency::class);
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }


    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //has many

    public function bureaus()
    {
        return $this->hasManyThrough(Bureau::class, Organisation::class);
    }

    public function househelps()
    {
        return $this->hasManyThrough(Househelp::class, Bureau::class);
    }

}
