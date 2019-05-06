<?php

namespace App\Models\Standard\Webservices;


use App\Models\Standard\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Standard\Webservices\Service;


class ServiceModel extends Model
{
    protected $fillable = [
        'title',
        'image',
        'details',
        'user_id',
        'service_id',
    ];
        //belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //has many
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
