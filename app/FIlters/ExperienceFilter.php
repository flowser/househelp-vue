<?php

// ExperienceFilter.php

namespace App\Filters;

class ExperienceFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('experience_id', '=', $value);                  
    }
}

