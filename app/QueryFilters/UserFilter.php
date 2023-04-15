<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends QueryFilter
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

    public function email(string $email): void
    {
        $this->builder->where('email', 'like', "%$email%");
    }

    public function roleId(string $roleId): void
    {
        if ($roleId == 'no') {
            $roleId = null;
        }
        $this->builder->where('role_id', $roleId);
    }
}
