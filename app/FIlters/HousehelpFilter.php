<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AgeFilter;
use App\Filters\SkillFilter;
use App\Filters\TribeFilter;
use App\Filters\GenderFilter;
use App\Filters\AbstractFilter;
use App\Filters\DurationFilter;
use App\Filters\IDstatusFilter;
use App\Filters\ReligionFilter;
use App\Filters\EducationFilter;
use App\Filters\KidstatusFilter;
use App\Filters\OperationFilter;
use App\Filters\ExperienceFilter;
use App\Filters\HealthstatusFilter;
use App\Filters\EnglishstatusFilter;
use App\Filters\MaritalstatusFilter;
use Illuminate\Database\Eloquent\Builder;

class HousehelpFilter extends AbstractFilter
{
    protected $filters = [
        'age' => AgeFilter::class,
        'gender_id' => GenderFilter::class,
        'education_id' => EducationFilter::class,
        'experience_id' => ExperienceFilter::class,
        'maritalstatus_id' => MaritalstatusFilter::class,
        'tribe_id' => TribeFilter::class,
        'skill_id' => SkillFilter::class,
        'operation_id' => OperationFilter::class,
        'duration_id' => DurationFilter::class,
        'englishstatus_id' => EnglishstatusFilter::class,
        'religion_id' => ReligionFilter::class,
        'kid_id' => KidstatusFilter::class,
        'healthstatus' => HealthstatusFilter::class,
        'idstatus' => IDstatusFilter::class,
    ];
}
