<?php

namespace App\Models\Client;

use App\Models\Client\Parcel;
use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use App\Models\Standard\Gender;
use App\Models\Standard\Country;
use App\Models\Standard\Constituency;
use App\Models\Client\Standard\Result;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client\Standard\Education;
use App\Models\Client\Standard\Certificate;
use App\Models\Client\Standard\Manual_Collection;
use App\Models\Client\Standard\Parcel_Collection;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'gender_id',
        'education_id',
        'photo',
        'background_image',
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

       public function results()
    {
        return $this->hasMany(Result::class);
    }
    public function manual_collections()
    {
        return $this->hasMany(Manual_Collection::class);
    }
    public function parcel_collections()
    {
        return $this->hasMany(Parcel_Collection::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
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
}
