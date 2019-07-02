<?php

namespace App\Models\Standard;

use App\Models\Bureau\Bureau;
use App\Models\Bureau\BureauAdmin;
use Laravel\Passport\HasApiTokens;
use App\Models\Househelp\Househelp;
use App\Models\Bureau\BureauDirector;
use App\Models\Househelp\HousehelpKin;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Client\OrganisationClient;
use App\Models\Organisation\Organisation;
use App\Models\Standard\Webservices\About;
use App\Models\Standard\Webservices\Advert;
use App\Models\Standard\Webservices\Feature;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organisation\OrganisationAdmin;
use App\Models\Organisation\OrganisationDirector;
use App\Models\Organisation\OrganisationEmployee;
use App\Models\Standard\Webservices\ServiceModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles,
        HasApiTokens,
        Notifiable,
        // SendUserPasswordReset,
        SoftDeletes;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */



    protected $fillable = [
        'first_name',
        'last_name',
        'user_type',
        'email',
        'password',
        'password_changed_at',
        'active',
        'confirmation_code',
        'confirmed',
        'timezone',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['last_login_at', 'deleted_at'];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'confirmed' => 'boolean',
    ];

      public function getFullNameAttribute()
      {
          return $this->last_name ? $this->first_name.' '.$this->last_name : $this->first_name;
      }

      /**
       * @return string
       */
      public function getNameAttribute()
      {
          return $this->full_name;
      }




      public function organisationdirectors()
      {
          return $this->belongsToMany(Organisation::class,'organisation_director')
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
                          'position_id',
                          'gender_id'
                      )
                      ->join('genders', 'organisation_director.gender_id', '=', 'genders.id')
                      ->join('positions', 'organisation_director.position_id', '=', 'positions.id')
                      ->join('countries', 'organisation_director.country_id', '=', 'countries.id')
                      ->join('counties', 'organisation_director.county_id', '=', 'counties.id')
                      ->join('constituencies', 'organisation_director.constituency_id', '=', 'constituencies.id')
                      ->join('wards', 'organisation_director.ward_id', '=', 'wards.id')
                      ->select(
                        'organisations.name as organisation_name', 'organisations.logo as organisation_logo',
                          'organisation_director.*',
                              'countries.name as country_name',
                              'counties.name as county_name',
                              'constituencies.name as constituency_name',
                              'wards.name as ward_name',
                              'positions.name as position_name',
                              'genders.name as gender_name'
                      )
                      ->withTimestamps();
      }
      public function organisationadmins()
      {
          return $this->belongsToMany(Organisation::class,'organisation_admin')
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
                          'position_id',
                          'gender_id'
                      )
                      ->join('genders', 'organisation_admin.gender_id', '=', 'genders.id')
                      ->join('positions', 'organisation_admin.position_id', '=', 'positions.id')
                      ->join('countries', 'organisation_admin.country_id', '=', 'countries.id')
                      ->join('counties', 'organisation_admin.county_id', '=', 'counties.id')
                      ->join('constituencies', 'organisation_admin.constituency_id', '=', 'constituencies.id')
                      ->join('wards', 'organisation_admin.ward_id', '=', 'wards.id')
                      ->select('organisations.*',
                          'organisation_admin.*',
                              'countries.name as country_name',
                              'counties.name as county_name',
                              'constituencies.name as constituency_name',
                              'wards.name as ward_name',
                              'positions.name as position_name',
                              'genders.name as gender_name'
                      )
                      ->withTimestamps();
      }
      public function organisationemployees()
      {
          return $this->belongsToMany(Organisation::class,'organisation_employee')
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
                          'position_id',
                          'gender_id'
                      )
                      ->join('genders', 'organisation_employee.gender_id', '=', 'genders.id')
                      ->join('positions', 'organisation_employee.position_id', '=', 'positions.id')
                      ->join('countries', 'organisation_employee.country_id', '=', 'countries.id')
                      ->join('counties', 'organisation_employee.county_id', '=', 'counties.id')
                      ->join('constituencies', 'organisation_employee.constituency_id', '=', 'constituencies.id')
                      ->join('wards', 'organisation_employee.ward_id', '=', 'wards.id')
                      ->select('organisations.*',
                          'organisation_employee.*',
                              'countries.name as country_name',
                              'counties.name as county_name',
                              'constituencies.name as constituency_name',
                              'wards.name as ward_name',
                              'positions.name as position_name',
                              'genders.name as gender_name'
                      )
                      ->withTimestamps();
      }
      public function organisationclients()
      {
          return $this->belongsToMany(Organisation::class,'organisation_client')
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
                          'gender_id'
                      )
                      ->join('genders', 'organisation_client.gender_id', '=', 'genders.id')
                      ->join('countries', 'organisation_client.country_id', '=', 'countries.id')
                      ->join('counties', 'organisation_client.county_id', '=', 'counties.id')
                      ->join('constituencies', 'organisation_client.constituency_id', '=', 'constituencies.id')
                      ->join('wards', 'organisation_client.ward_id', '=', 'wards.id')
                      ->select('organisations.*',
                          'organisation_client.*',
                              'countries.name as country_name',
                              'counties.name as county_name',
                              'constituencies.name as constituency_name',
                              'wards.name as ward_name',
                              'genders.name as gender_name'
                      )
                      ->withTimestamps();
      }
      public function organisationaffiliates()
      {
          return $this->belongsToMany(Organisation::class,'organisation_affiliate')
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
                          'position_id',
                          'gender_id'
                      )
                      ->join('genders', 'organisation_affiliate.gender_id', '=', 'genders.id')
                      ->join('countries', 'organisation_affiliate.country_id', '=', 'countries.id')
                      ->join('counties', 'organisation_affiliate.county_id', '=', 'counties.id')
                      ->join('constituencies', 'organisation_affiliate.constituency_id', '=', 'constituencies.id')
                      ->join('wards', 'organisation_affiliate.ward_id', '=', 'wards.id')
                      ->select('organisations.*',
                          'organisation_affiliate.*',
                              'countries.name as country_name',
                              'counties.name as county_name',
                              'constituencies.name as constituency_name',
                              'wards.name as ward_name',
                              'genders.name as gender_name'
                      )
                      ->withTimestamps();
      }



    public function bureaudirectors()
    {
        return $this->belongsToMany(Bureau::class,'bureau_director')
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
                        'position_id',
                        'gender_id'
                    )
                    ->join('genders', 'bureau_director.gender_id', '=', 'genders.id')
                    ->join('positions', 'bureau_director.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_director.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_director.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_director.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_director.ward_id', '=', 'wards.id')
                    ->select('bureaus.*',
                        'bureau_director.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    )
                    ->withTimestamps();
    }
    public function bureauadmins()
    {
        return $this->belongsToMany(Bureau::class,'bureau_admin')
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
                        'position_id',
                        'gender_id'
                    )
                    ->join('genders', 'bureau_admin.gender_id', '=', 'genders.id')
                    ->join('positions', 'bureau_admin.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_admin.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_admin.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_admin.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_admin.ward_id', '=', 'wards.id')
                    ->select('bureaus.*',
                        'bureau_admin.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    )
                    ->withTimestamps();
    }
    public function bureauemployees()
    {
        return $this->belongsToMany(Bureau::class,'bureau_employee')
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
                        'position_id',
                        'gender_id'
                    )
                    ->join('genders', 'bureau_employee.gender_id', '=', 'genders.id')
                    ->join('positions', 'bureau_employee.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_employee.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_employee.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_employee.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_employee.ward_id', '=', 'wards.id')
                    ->select('bureaus.*',
                        'bureau_employee.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    )
                    ->withTimestamps();
    }
    // househelps
    public function bureauhousehelps()
    {
        return $this->belongsToMany(Bureau::class,'bureau_househelp','user_id')
                    ->withPivot(
                        'photo',
                        'about_me',
                        'phone',
                        'address',
                        'active',
                        'employmentstatus',
                        'hiredstatus',
                        'country_id',
                        'county_id',
                        'constituency_id',
                        'ward_id',
                        //filters
                        'age',
                        'gender_id',
                        'education_id',
                        'experience_id',
                        'maritalstatus_id',
                        'tribe_id',
                        'skill_id',
                        'operation_id',
                        'duration_id',
                        'englishstatus_id',
                        'religion_id',
                        'kid_id'
                    )
                    ->join('countries', 'bureau_househelp.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_househelp.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_househelp.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_househelp.ward_id', '=', 'wards.id')
                    ->join('genders', 'bureau_househelp.gender_id', '=', 'genders.id')
                    ->join('education', 'bureau_househelp.education_id', '=', 'education.id')
                    ->join('experiences', 'bureau_househelp.experience_id', '=', 'experiences.id')
                    ->join('maritalstatuses', 'bureau_househelp.maritalstatus_id', '=', 'maritalstatuses.id')
                    ->join('tribes', 'bureau_househelp.tribe_id', '=', 'tribes.id')
                    ->join('skills', 'bureau_househelp.skill_id', '=', 'skills.id')
                    ->join('operations', 'bureau_househelp.operation_id', '=', 'operations.id')
                    ->join('durations', 'bureau_househelp.duration_id', '=', 'durations.id')
                    ->join('englishstatuses', 'bureau_househelp.englishstatus_id', '=', 'englishstatuses.id')
                    ->join('religions', 'bureau_househelp.religion_id', '=', 'religions.id')
                    ->join('kids', 'bureau_househelp.kid_id', '=', 'kids.id')
                    ->join('healthstatuses', 'healthstatuses.bureau_househelp_id', '=', 'bureau_househelp.id')
                    ->join('idstatuses', 'idstatuses.bureau_househelp_id', '=', 'bureau_househelp.id')
                    ->select('bureaus.*',
                        'bureau_househelp.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'genders.name as gender_name',
                            'education.name as education_name',
                            'experiences.name as experience_name',
                            'maritalstatuses.name as maritalstatus_name',
                            'tribes.name as tribe_name',
                            'skills.name as skill_name',
                            'operations.name as operation_name',
                            'durations.name as duration_name',
                            'englishstatuses.name as englishstatus_name',
                            'religions.name as religion_name',
                            'kids.name as kid_name',
                            'healthstatuses.id as healthstatus_id',
                            'healthstatuses.status as healthstatus_status',
                            'healthstatuses.HIV_status as healthstatus_HIV_status',
                            'healthstatuses.other_chronics as healthstatus_other_chronics',
                            'healthstatuses.chronic_details as healthstatus_chronic_details',
                            'healthstatuses.allergy as healthstatus_allergy',
                            'healthstatuses.specify as healthstatus_specify',
                            'idstatuses.id as idstatus_id',
                            'idstatuses.status as idstatus_status',
                            'idstatuses.reason as idstatus_reason',
                            'idstatuses.id_number as idstatus_id_number',
                            'idstatuses.ref_number as idstatus_ref_number',
                            'idstatuses.id_photo_front as idstatus_id_photo_front',
                            'idstatuses.id_photo_back as idstatus_id_photo_back',
                            'idstatuses.waiting_card_photo as idstatus_waiting_card_photo'
                    )
                    ->withTimestamps();
    }
    // //logged in househelp

    //houshelps kins
    public function househelpkin()
    {
        return $this->hasOne(HousehelpKin::class)
                    ->leftjoin('genders', 'househelp_kin.gender_id', '=', 'genders.id')
                    ->leftjoin('relationships', 'househelp_kin.relationship_id', '=', 'relationships.id')
                    ->leftjoin('countries', 'househelp_kin.country_id', '=', 'countries.id')
                    ->leftjoin('counties', 'househelp_kin.county_id', '=', 'counties.id')
                    ->leftjoin('constituencies', 'househelp_kin.constituency_id', '=', 'constituencies.id')
                    ->leftjoin('wards', 'househelp_kin.ward_id', '=', 'wards.id')
                    ->select(
                        'househelp_kin.*',
                            'genders.name as gender_name',
                            'relationships.name as relationship_name',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name'
                    );
    }

    public function abouts()
    {
        return $this->hasMany(About::class);
    }
    public function features()
    {
        return $this->hasMany(Feature::class);
    }
    public function servicemodels()
    {
        return $this->hasMany(ServiceModel::class);
    }
    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }

    //logged in users

    public function organisationdirector()
    {
        return $this->hasOne(OrganisationDirector::class)
                    ->join('organisations', 'organisation_director.organisation_id','=', 'organisations.id')
                    ->join('genders', 'organisation_director.gender_id', '=', 'genders.id')
                    ->join('positions', 'organisation_director.position_id', '=', 'positions.id')
                    ->join('countries', 'organisation_director.country_id', '=', 'countries.id')
                    ->join('counties', 'organisation_director.county_id', '=', 'counties.id')
                    ->join('constituencies', 'organisation_director.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'organisation_director.ward_id', '=', 'wards.id')
                    ->select(
                        'organisations.name as organisation_name', 'organisations.logo as organisation_logo',
                        'organisation_director.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );

    }
    public function organisationadmin()
    {
        return $this->hasOne(OrganisationAdmin::class)
        ->join('organisations', 'organisation_admin.organisation_id','=', 'organisations.id')
                    ->join('genders', 'organisation_admin.gender_id', '=', 'genders.id')
                    ->join('positions', 'organisation_admin.position_id', '=', 'positions.id')
                    ->join('countries', 'organisation_admin.country_id', '=', 'countries.id')
                    ->join('counties', 'organisation_admin.county_id', '=', 'counties.id')
                    ->join('constituencies', 'organisation_admin.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'organisation_admin.ward_id', '=', 'wards.id')
                    ->select(
                        'organisations.name as organisation_name', 'organisations.logo as organisation_logo',
                        'organisation_admin.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );

    }
    public function organisationemployee()
    {
        return $this->hasOne(OrganisationEmployee::class)
        ->join('organisations', 'organisation_employee.organisation_id','=', 'organisations.id')
                    ->join('genders', 'organisation_employee.gender_id', '=', 'genders.id')
                    ->join('positions', 'organisation_employee.position_id', '=', 'positions.id')
                    ->join('countries', 'organisation_employee.country_id', '=', 'countries.id')
                    ->join('counties', 'organisation_employee.county_id', '=', 'counties.id')
                    ->join('constituencies', 'organisation_employee.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'organisation_employee.ward_id', '=', 'wards.id')
                    ->select(
                        'organisations.name as organisation_name', 'organisations.logo as organisation_logo',
                        'organisation_employee.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );

    }
    public function organisationclient()
    {
        return $this->hasOne(OrganisationClient::class)
        ->join('organisations', 'organisation_client.organisation_id','=', 'organisations.id')
                    ->join('genders', 'organisation_client.gender_id', '=', 'genders.id')
                    ->join('positions', 'organisation_client.position_id', '=', 'positions.id')
                    ->join('countries', 'organisation_client.country_id', '=', 'countries.id')
                    ->join('counties', 'organisation_client.county_id', '=', 'counties.id')
                    ->join('constituencies', 'organisation_client.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'organisation_client.ward_id', '=', 'wards.id')
                    ->select(
                        'organisations.name as organisation_name', 'organisations.logo as organisation_logo',
                        'organisation_client.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );

    }


    public function bureaudirector()
    {
        return $this-> hasOne(BureauDirector::class)
                    ->join('bureaus', 'bureau_director.bureau_id','=', 'bureaus.id')
                    ->join('organisations', 'bureaus.organisation_id','=', 'organisations.id')
                    ->join('genders', 'bureau_director.gender_id', '=', 'genders.id')
                    ->join('positions', 'bureau_director.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_director.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_director.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_director.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_director.ward_id', '=', 'wards.id')
                    ->select(
                        'bureaus.name as bureau_name','bureaus.logo as bureau_logo', 'bureaus.bureau_email as bureau_email',
                        'organisations.name as organisations_name', 'organisations.logo as organisations_logo',
                        'bureau_director.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );
    }
    public function bureauadmin()
    {
        return $this-> hasOne(BureauAdmin::class)
                    ->join('bureaus', 'bureau_admin.bureau_id','=', 'bureaus.id')
                    ->join('organisations', 'bureaus.organisation_id','=', 'organisations.id')
                    ->join('genders', 'bureau_admin.gender_id', '=', 'genders.id')
                    ->join('positions', 'bureau_admin.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_admin.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_admin.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_admin.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_admin.ward_id', '=', 'wards.id')
                    ->select(
                        'bureaus.name as bureau_name','bureaus.logo as bureau_logo', 'bureaus.bureau_email as bureau_email',
                        'organisations.name as organisations_name', 'organisations.logo as organisations_logo',
                        'bureau_admin.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );
    }
    public function bureauemployee()
    {
        return $this-> hasOne(BureauAdmin::class)
                    ->join('bureaus', 'bureau_employee.bureau_id','=', 'bureaus.id')
                    ->join('organisations', 'bureaus.organisation_id','=', 'organisations.id')
                    ->join('genders', 'bureau_employee.gender_id', '=', 'genders.id')
                    ->join('positions', 'bureau_employee.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_employee.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_employee.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_employee.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_employee.ward_id', '=', 'wards.id')
                    ->select(
                        'bureaus.name as bureau_name','bureaus.logo as bureau_logo', 'bureaus.bureau_email as bureau_email',
                        'organisations.name as organisations_name', 'organisations.logo as organisations_logo',
                        'bureau_employee.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name',
                            'genders.name as gender_name'
                    );
    }

    public function househelp()
    {
        return $this->hasOne(Househelp::class, 'user_id');
    }



//



}
