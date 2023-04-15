<?php

namespace App\DataCollectors;

use App\Repositories\ReasonRepository;
use App\Sorters\ReasonSorter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property ReasonRepository $repository
 */
class ReasonDataCollector extends BaseDataCollector
{
    use StoreAndUpdateDataGetters;
    use SortLinkGetter;

    /**
     * @param Request $request
     * @return ReasonSorter
     */
    protected function getSorter(Request $request): ReasonSorter
    {
        return new ReasonSorter($request);
    }

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        $sorter = $this->getSorter($request);

        $this->viewData['sortLink']  = $this->getSortLink($request, $sorter->getOrder());
        $this->viewData['paginator'] = $this->getReasonsWithPaginate($sorter);

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['reason'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->viewData['reason'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getEditViewData(Model $model): array
    {
        return $this->getCreateViewData($model);
    }

    /**
     * @param ReasonSorter $sorter
     * @return mixed
     */
    private function getReasonsWithPaginate(ReasonSorter $sorter): mixed
    {
        return $this->repository->getAllWithPaginate($sorter);
    }
}
