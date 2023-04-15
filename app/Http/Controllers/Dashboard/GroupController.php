<?php

namespace App\Http\Controllers\Dashboard;

use App\DataImporters\DataImporter;
use App\DataImporters\GroupDataImporter;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class GroupController extends BaseController
{
    use UploadFileMethods;

    /**
     * @return DataImporter
     */
    protected function getDataImporter(): DataImporter
    {
        return new GroupDataImporter();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(GroupStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(GroupUpdateRequest $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
