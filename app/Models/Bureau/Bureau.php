<?php

namespace App\Models\Bureau;

use App\Models\Standard\User;
use App\Models\Standard\Ward;
use App\Models\Standard\County;
use App\Models\Standard\Country;
use App\Models\Househelp\Househelp;
use App\Models\Standard\Constituency;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;





class Bureau extends Model
{
    protected $fillable = [
        'organisation_id',
        'name',
        'logo',
        'about_us',
        'what_we_do',
        'bureau_email',
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
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function bureaudirectors()
    {
        return $this->belongsToMany(User::class,'bureau_director')
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
                    ->join('positions', 'bureau_director.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_director.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_director.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_director.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_director.ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'bureau_director.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }
    public function bureauadmins()
    {
        return $this->belongsToMany(User::class,'bureau_admin')
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
                    ->join('positions', 'bureau_admin.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_admin.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_admin.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_admin.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_admin.ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'bureau_admin.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }
    public function bureauemployees()
    {
        return $this->belongsToMany(User::class,'bureau_employee')
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
                    ->join('positions', 'bureau_employee.position_id', '=', 'positions.id')
                    ->join('countries', 'bureau_employee.country_id', '=', 'countries.id')
                    ->join('counties', 'bureau_employee.county_id', '=', 'counties.id')
                    ->join('constituencies', 'bureau_employee.constituency_id', '=', 'constituencies.id')
                    ->join('wards', 'bureau_employee.ward_id', '=', 'wards.id')
                    ->select('users.*',
                        'bureau_employee.*',
                            'countries.name as country_name',
                            'counties.name as county_name',
                            'constituencies.name as constituency_name',
                            'wards.name as ward_name',
                            'positions.name as position_name'
                    )
                    ->withTimestamps();
    }

    public function bureauhousehelps()
    {
        return $this->belongsToMany(User::class,'bureau_househelp','bureau_id')
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
                    ->select('users.*',
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
                            'healthstatuses.status as healthstatus_status',
                            'healthstatuses.HIV_status as healthstatus_HIV_status',
                            'healthstatuses.other_chronics as healthstatus_other_chronics',
                            'healthstatuses.chronic_details as healthstatus_chronic_details',
                            'healthstatuses.allergy as healthstatus_allergy',
                            'healthstatuses.specify as healthstatus_specify',
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
}
