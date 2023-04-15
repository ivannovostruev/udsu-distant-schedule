<?php

namespace App\DataCollectors;

use App\Utilities\SortLink;
use Illuminate\Http\Request;

trait SortLinkGetter
{
    /**
     * @param Request $request
     * @param int $currentOrder
     * @return SortLink
     */
    protected function getSortLink(Request $request, int $currentOrder): SortLink
    {
        return new SortLink($request, $currentOrder);
    }
}
