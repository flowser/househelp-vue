<?php

// OperationFilter.php

namespace App\Filters;

class OperationFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('operation_id', '=', $value);                       
    }
}

