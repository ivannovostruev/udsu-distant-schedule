<?php

namespace App\Http\Controllers\Dashboard;

use App\DataCollectors\DataCollector;
use App\DataCollectors\Exceptions\DataCollectorException;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Dashboard;
use App\ModelServices\Exceptions\ModelServiceException;
use App\ModelServices\ModelService;
use App\Repositories\BaseRepository;
use App\Support\Abilities\Abilities;
use App\Support\ModelManagers\ModelManager;
use App\Support\Pages\Page;
use App\Support\RouteNames\RouteNames;
use App\Support\ViewNames\ViewNames;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

abstract class BaseController extends Controller
{
    use DataCollectorMethods;
    use ViewNamesMethods;
    use AbilitiesMethods;
    use RedirectMethods;
    use ViewMethods;

    public static string $msgSaveSuccess  = 'Успешно сохранено';
    public static string $msgSaveError    = 'Ошибка сохранения';
    public static string $msgDestroyError = 'Ошибка удаления';

    protected BaseRepository $repository;
    protected DataCollector $dataCollector;
    protected ModelManager $modelManager;
    protected ModelService $modelService;

    protected Page $page;
    protected Abilities $abilities;
    protected RouteNames $routeNames;
    protected ViewNames $viewNames;

    public function __construct(
        BaseRepository $repository,
        DataCollector $dataCollector,
        ModelService $modelService,
        ModelManager $modelManager
    ) {
        $this->repository    = $repository;
        $this->dataCollector = $dataCollector;
        $this->modelService  = $modelService;
        $this->modelManager  = $modelManager;

        $this->page         = $modelManager->getPage();
        $this->abilities    = $modelManager->getAbilities();
        $this->routeNames   = $modelManager->getRouteNames();
        $this->viewNames    = $modelManager->getViewNames();

        $this->shareVariablesInView();
    }

    protected function shareVariablesInView(): void
    {
        View::share('dashboard', new Dashboard());
        View::share('routeNames', $this->routeNames);
        View::share('abilities', $this->abilities);
        View::share('page', $this->page);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|ContractView|Response
     * @throws AuthorizationException
     */
    public function index(Request $request): ContractView|Factory|Response|Application
    {
        $this->authorize($this->getIndexAbility());
        return $this->getIndexView($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|ContractView|Response
     * @throws AuthorizationException
     */
    public function create(): ContractView|Factory|Response|Application
    {
        $model = $this->newModel();
        $this->authorize($this->getCreateAbility());
        return $this->getCreateView($model);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|ContractView|Response
     * @throws AuthorizationException
     */
    public function show(int $id): ContractView|Factory|Response|Application
    {
        $model = $this->getModelById($id);
        $this->authorize($this->getShowAbility());
        return $this->getShowView($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|ContractView|Response
     * @throws AuthorizationException
     */
    public function edit(int $id): ContractView|Factory|Response|Application
    {
        $model = $this->getModelById($id);
        $this->authorize($this->getEditAbility(), $model);
        return $this->getEditView($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function destroy(int $id): Response|RedirectResponse
    {
        $model = $this->getModelById($id);
        $this->authorize($this->getDestroyAbility());
        if (!$this->destroyModel($model)) {
            return $this->backWithErrors(self::$msgDestroyError);
        }
        return $this->redirectWhenDestroySuccess($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function baseStore(Request $request): Response|RedirectResponse
    {
        $this->authorize($this->getStoreAbility());

        $model = $this->newModel();
        try {
            $data = $this->getStoreData($request);
            $this->storeModel($model, $data);
        } catch (ModelServiceException | DataCollectorException $e) {
            return $this->backWithErrorsAndInput([$e->getMessage()]);
        }
        return $this->redirectWhenStoreSuccess();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     * @throws AuthorizationException
     */
    public function baseUpdate(Request $request, int $id): Response|RedirectResponse
    {
        $model = $this->getModelById($id);

        $this->authorize($this->getUpdateAbility());

        try {
            $data = $this->getUpdateData($request);
            $this->updateModel($model, $data);
        } catch (ModelServiceException | DataCollectorException $e) {
            return $this->backWithErrors($e->getMessage());
        }
        return $this->redirectWhenUpdateSuccess($model->id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function getModelById(int $id): mixed
    {
        $model = $this->repository->getById($id);
        abort_if(!$model, 404);
        return $model;
    }

    /**
     * @return Model
     */
    protected function newModel(): Model
    {
        return $this->repository->getModel();
    }

    /**
     * @param Model $model
     * @param array $data
     * @return mixed
     * @throws ModelServiceException
     */
    protected function storeModel(Model $model, array $data): void
    {
        $this->modelService->create($model, $data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return void
     * @throws ModelServiceException
     */
    protected function updateModel(Model $model, array $data): void
    {
        $this->modelService->update($model, $data);
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    protected function destroyModel(Model $model): ?bool
    {
        return $this->modelService->delete($model);
    }
}
