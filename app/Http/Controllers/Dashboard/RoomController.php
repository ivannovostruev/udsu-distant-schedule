<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RoomController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param RoomStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(RoomStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(RoomUpdateRequest $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
