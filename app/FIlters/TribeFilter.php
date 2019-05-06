<?php

// TribeFilter.php

namespace App\Filters;

class TribeFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('tribe_id', '=', $value);                       
    }
}

