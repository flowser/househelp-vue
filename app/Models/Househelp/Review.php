<?php

namespace App\Models\Househelp;

use App\Models\Househelp\Househelp;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client\OrganisationClient;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'organisation_client_id',
        'bureau_househelp_id',
        'review',
        'what_to_improve',
        'work_efficiency_rating',
        'hygiene_rating',
        'children_rapport_rating',
        'truthfullness_rating',
        'morality_rating',
        'obedience_rating',
        'approval_status'
    ];

    protected $casts = [
        'approval_status' => 'boolean',
    ];

    public function organisationclient()
    {
        return $this->belongsTo(OrganisationClient::class, 'organisation_client_id')
                    ->leftjoin('users', 'organisation_client.user_id', '=', 'users.id')
                    ->select('organisation_client.*',
                       'users.id as client_user_id',
                       'users.first_name as user_first_name',
                       'users.last_name as user_last_name',
                       'users.email as user_emal'
                    );
    }
    public function bureauhousehelp()
    {
        return $this->belongsTo(Househelp::class, 'bureau_househelp_id')
                    ->leftjoin('users', 'bureau_househelp.user_id', '=', 'users.id')
                    ->select('bureau_househelp.*',
                       'users.id as househelp_user_id',
                       'users.first_name as user_first_name',
                       'users.last_name as user_last_name',
                       'users.email as user_emal'
                    );
    }
    public function bureau()
    {
        return $this->belongsTo(Househelp::class, 'bureau_househelp_id')
                    ->leftjoin('bureaus', 'bureau_househelp.bureau_id', '=', 'bureaus.id')
                    ->select(
                       'bureaus.id as bureau_id',
                       'bureaus.name as bureau_name'
                    );
    }
}
