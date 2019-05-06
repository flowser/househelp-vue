<?php

// DurationFilter.php

namespace App\Filters;

class DurationFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('duration_id', '=', $value);                       
    }
}

