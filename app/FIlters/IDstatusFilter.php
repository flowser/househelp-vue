<?php

// IdstatusFilter.php

namespace App\Filters;

use App\Models\Househelp\Househelp;

class IDstatusFilter
{
    public function filter($builder, $value)
    {

        return $builder->whereHas('idstatus', function($query) use($value)
                                    {
                                    $query ->where('status', $value);
                                    }
                                );
    }
}

