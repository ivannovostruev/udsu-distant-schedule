<?php

namespace App\DataCollectors;

use App\Utilities\RecordPerPageSelector;
use Illuminate\Http\Request;

trait PerPageSelectorGetter
{
    /**
     * @param Request $request
     * @return RecordPerPageSelector
     */
    protected function getPerPageSelector(Request $request): RecordPerPageSelector
    {
        return new RecordPerPageSelector($request);
    }
}
