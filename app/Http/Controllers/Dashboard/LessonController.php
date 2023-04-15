<?php

namespace App\Http\Controllers\Dashboard;

use App\DataCollectors\Exceptions\DataCollectorException;
use App\DataCollectors\LessonDataCollector;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\ModelServices\Exceptions\ModelServiceException;
use App\ModelServices\LessonService;
use App\Support\Abilities\LessonAbilities;
use App\Support\RouteNames\LessonRouteNames;
use App\Support\ViewNames\LessonViewNames;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

/**
 * @property LessonService $modelService
 * @property LessonDataCollector $dataCollector
 * @property LessonAbilities $abilities
 * @property LessonRouteNames $routeNames
 * @property LessonViewNames $viewNames
 */
class LessonController extends BaseController
{
    use LessonControllerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param LessonStoreRequest $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function store(LessonStoreRequest $request): Response|RedirectResponse
    {
        return $this->baseStore($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LessonUpdateRequest $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function update(LessonUpdateRequest $request, int $id): Response|RedirectResponse
    {
        $model = $this->getModelById($id);

        $this->authorize($this->getUpdateAbility(), $model);

        try {
            $data = $this->getUpdateData($request);
            $this->updateModel($model, $data);
        } catch (ModelServiceException | DataCollectorException $e) {
            return $this->backWithErrors($e->getMessage());
        }
        if (Gate::denies($this->getUpdateAbility(), $model)) {
            return $this->redirectWhenStoreSuccess();
        }
        return $this->redirectWhenUpdateSuccess($model->id);
    }

    /**
     * @param LessonUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function approve(LessonUpdateRequest $request, int $id): RedirectResponse
    {
        $model = $this->getModelById($id);

        $this->authorize($this->getApproveAbility(), $model);

        try {
            $data = $this->getApproveData($request);
            $this->updateModel($model, $data);
        } catch (ModelServiceException | DataCollectorException $e) {
            return $this->backWithErrors($e->getMessage());
        }
        return $this->redirectToRoute($this->routeNames->index());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|ContractView|Response
     * @throws AuthorizationException
     */
    public function fastCreate(Request $request): ContractView|Factory|Response|Application
    {
        $this->authorize($this->getCreateAbility());
        return $this->getFastCreateView($request, $this->newModel());
    }
}
