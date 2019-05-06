<?php

// TypeFilter.php

namespace App\Filters;

class AgeFilter
{
    public function filter($builder, $value)
    {
        // if($value >=1){
        //     foreach ($value as $val){
        //         $age = explode("-", $val);
        //             $start = $age[0];
        //             $end = $age[1];
        //     }
        // }else{
            $age = explode("-", $value);
                    $start = $age[0];
                    $end = $age[1];
        // }

        return $builder->where('age', '>=', $start)
                       ->where('age', '<=', $end);


    }
}
