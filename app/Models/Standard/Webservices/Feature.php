<?php

namespace App\Models\Standard\Webservices;

use App\Models\Standard\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;



class Feature extends Model
{
    protected $fillable = [
        'title',
        'details',
        'image',
        'user_id',
        'organisation_id',
    ];

    //belongs to
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
}
