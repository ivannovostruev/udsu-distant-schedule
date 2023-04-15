<?php

namespace App\DataCollectors;

use Illuminate\Http\Request;

trait StoreAndUpdateDataGetters
{
    /**
     * @param Request $request
     * @return array
     */
    public function getStoreData(Request $request): array
    {
        return $request->input();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUpdateData(Request $request): array
    {
        return $request->input();
    }
}
