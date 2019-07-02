<?php

namespace App\Models\Househelp;



use App\Models\Bureau\Bureau;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use App\Models\Standard\Gender;
use App\Models\Standard\Country;
use App\Models\Househelp\Househelp;
use App\Models\Standard\Constituency;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;

class HousehelpKin extends Model
{
    protected $table = 'househelp_kin';
    protected $fillable = [
        'user_id',
        'bureau_househelp_id',
        'relationship_id',
        'photo',
        'background_image',

        'id_no',
        'id_photo_front',
        'id_photo_back',
        'phone',
        'address',
        'active',

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

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }
    public function househelp()
    {
        return $this->belongsTo(Househelp::class);
    }

}
