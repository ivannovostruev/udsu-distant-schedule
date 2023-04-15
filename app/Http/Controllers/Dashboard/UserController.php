<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(Request $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
