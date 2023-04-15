<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\TimeslotStoreRequest;
use App\Http\Requests\TimeslotUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TimeslotController extends BaseController
{
    use DisableDestroy;

    /**
     * Store a newly created resource in storage.
     *
     * @param TimeslotStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(TimeslotStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TimeslotUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(TimeslotUpdateRequest $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
