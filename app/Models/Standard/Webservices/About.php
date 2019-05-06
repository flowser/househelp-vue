<?php

namespace App\Models\Standard\Webservices;

use App\Models\Standard\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\Organisation;

class About extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'front_image',
        'why_choose_us',
        'who_we_are',
        'what_we_do',
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

}
