<?php

// ReligionFilter.php

namespace App\Filters;

class ReligionFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('religion_id', '=', $value);                       
    }
}

