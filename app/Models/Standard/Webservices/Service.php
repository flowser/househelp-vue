<?php

namespace App\Models\Standard\Webservices;

use App\Models\Standard\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;
use App\Models\Standard\Webservices\ServiceModel;


class Service extends Model
{
    protected $fillable = [
        'title',
        'service_image',
        'service_title',
        'service_details',
        'user_id',
        'organisation_id',
    ];
        //belongs to
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //has many
    public function servicemodels()
    {
        return $this->hasMany(ServiceModel::class);
    }



}
