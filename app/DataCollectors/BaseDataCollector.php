<?php

namespace App\DataCollectors;

use App\DataCollectors\Exceptions\DataCollectorException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseDataCollector extends DataCollector
{
    use ViewData;
    use PerPageSelectorGetter;

    /**
     * @var BaseRepository
     */
    protected BaseRepository $repository;

    /**
     * @param BaseRepository $repository
     */
    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;

        $this->dataCollectorHook();
    }

    /**
     * Override if needed
     */
    public function dataCollectorHook(): void {}

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getEditViewData(Model $model): array
    {
        return $this->viewData;
    }

    /**
     * @param Request $request
     * @return array
     * @throws DataCollectorException
     */
    public function getStoreData(Request $request): array
    {
        return $this->data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws DataCollectorException
     */
    public function getUpdateData(Request $request): array
    {
        return $this->data;
    }
}
