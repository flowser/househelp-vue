<?php

// EnglishstatusFilter.php

namespace App\Filters;

class EnglishstatusFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('englishstatus_id', '=', $value);                       
    }
}

