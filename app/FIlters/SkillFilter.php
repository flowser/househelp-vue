<?php

// SkillFilter.php

namespace App\Filters;

class SkillFilter
{
    public function filter($builder, $value)
    {        
        return $builder->where('skill_id', '=', $value);                       
    }
}

