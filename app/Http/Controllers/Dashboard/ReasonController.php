<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ReasonStoreRequest;
use App\Http\Requests\ReasonUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ReasonController extends BaseController
{
    use DisableDestroy;

    /**
     * Store a newly created resource in storage.
     *
     * @param ReasonStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(ReasonStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReasonUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(ReasonUpdateRequest $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
