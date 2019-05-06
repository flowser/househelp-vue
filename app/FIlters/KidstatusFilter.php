<?php

// KidstatusFilter.php

namespace App\Filters;

class KidstatusFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('kid_id', '=', $value);                       
    }
}

