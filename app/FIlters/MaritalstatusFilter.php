<?php

// MaritalstatusFilter.php

namespace App\Filters;

class MaritalstatusFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('maritalstatus_id', '=', $value);                       
    }
}

