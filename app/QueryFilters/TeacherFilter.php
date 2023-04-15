<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class TeacherFilter extends QueryFilter
{
    public function fullName(string $fullName): void
    {
        $words = array_filter(explode(' ', $fullName));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('full_name', 'like', "%$word%");
            }
        });
    }

    public function email(string $email): void
    {
        $this->builder->where('email', 'like', "%$email%");
    }
}
