<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class GroupFilter extends QueryFilter
{
    public function name(string $name): void
    {
        $words = array_filter(explode(' ', $name));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('name', 'like', "%$word%");
            }
        });
    }
}
