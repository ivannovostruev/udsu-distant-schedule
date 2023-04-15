<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ColorStoreRequest;
use App\Http\Requests\ColorUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ColorController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ColorStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(ColorStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ColorUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(ColorUpdateRequest $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
