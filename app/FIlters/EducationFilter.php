<?php

// EducationFilter.php

namespace App\Filters;

class EducationFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('education_id', '=', $value);                       
    }
}

