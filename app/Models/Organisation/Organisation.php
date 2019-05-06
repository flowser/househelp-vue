<?php

namespace App\Models\Organisation;

use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use App\Models\Standard\Country;
use App\Models\Standard\Constituency;
use Illuminate\Database\Eloquent\Model;
use App\Models\Standard\Webservices\About;
use App\Models\Standard\Webservices\Advert;
use App\Models\Standard\Webservices\Feature;
use App\Models\Standard\Webservices\Service;
use App\Models\Organisation\OrganisationDirector;
use App\Models\Standard\Webservices\ServiceModel;


class Organisation extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'organisation_email',
        'phone',
        'landline',
        'website',
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


    //has many
    public function organisationdirectors()
    {
        return $this->belongsToMany(User::class,'organisation_director')
                    ->withPivot(
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
                        'position_id'
                    )
                    ->join('positions', 'position_id', '=', 'positions.id')
                    ->join('countries', 'country_id', '=', 'countries.id')
                    ->join('counties', 'county_id', '=', 'counties.id')
                    ->join('constituencies', 'constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'organisation_director.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }
    public function organisationadmins()
    {
        return $this->belongsToMany(User::class,'organisation_admin')
                    ->withPivot(
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
                        'position_id'
                    )
                    ->join('positions', 'position_id', '=', 'positions.id')
                    ->join('countries', 'country_id', '=', 'countries.id')
                    ->join('counties', 'county_id', '=', 'counties.id')
                    ->join('constituencies', 'constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'organisation_admin.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }
    public function organisationemployees()
    {
        return $this->belongsToMany(User::class,'organisation_employee')
                    ->withPivot(
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
                        'position_id'
                    )
                    ->join('positions', 'position_id', '=', 'positions.id')
                    ->join('countries', 'country_id', '=', 'countries.id')
                    ->join('counties', 'county_id', '=', 'counties.id')
                    ->join('constituencies', 'constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'organisation_employee.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }
    public function organisationaffiliates()
    {
        return $this->belongsToMany(User::class,'organisation_affiliate')
                    ->withPivot(
                        'photo',
                        'active',
                        'id_no',
                        'id_photo_front',
                        'id_photo_back',
                        'about_me',
                        'phone',
                        'address',
                        'country_id',
                        'county_id',
                        'constituency_id',
                        'ward_id',
                        'position_id'
                    )
                    ->join('positions', 'organisation_affiliate.position_id', '=', 'positions.id')
                    ->join('countries', 'organisation_affiliate.country_id', '=', 'countries.id')
                    ->join('counties', 'organisation_affiliate.county_id', '=', 'counties.id')
                    ->join('constituencies', 'organisation_affiliate.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'organisation_affiliate.ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'organisation_affiliate.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }





    //about page
    public function about()
    {
        return $this->hasOne(About::class);
    }

    //service page
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function servicemodels()
    {
        return $this->hasManyThrough(ServiceModel::class, Service::class);
    }
    public function features()
    {
        return $this->hasMany(Feature::class);
    }
    //advert page or section
    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

}
