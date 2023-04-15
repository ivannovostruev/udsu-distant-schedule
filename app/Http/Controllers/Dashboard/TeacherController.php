<?php

namespace App\Http\Controllers\Dashboard;

use App\DataImporters\DataImporter;
use App\DataImporters\TeacherDataImporter;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TeacherController extends BaseController
{
    use UploadFileMethods;

    /**
     * @return DataImporter
     */
    protected function getDataImporter(): DataImporter
    {
        return new TeacherDataImporter();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(TeacherStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(TeacherUpdateRequest $request, int $id): Response|RedirectResponse
    {
        return $this->baseUpdate($request, $id);
    }
}
