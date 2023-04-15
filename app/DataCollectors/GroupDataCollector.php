<?php

namespace App\DataCollectors;

use App\QueryFilters\GroupFilter;
use App\Repositories\GroupRepository;
use App\Sorters\GroupSorter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property GroupRepository $repository
 */
class GroupDataCollector extends BaseDataCollector
{
    use StoreAndUpdateDataGetters;
    use SortLinkGetter;

    /**
     * @param Request $request
     * @return GroupFilter
     */
    protected function getFilter(Request $request): GroupFilter
    {
        return new GroupFilter($request);
    }

    /**
     * @param Request $request
     * @return GroupSorter
     */
    protected function getSorter(Request $request): GroupSorter
    {
        return new GroupSorter($request);
    }

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        $filter             = $this->getFilter($request);
        $sorter             = $this->getSorter($request);
        $perPageSelector    = $this->getPerPageSelector($request);
        $perPage            = $perPageSelector->getPerPage();

        $this->viewData['sortLink']         = $this->getSortLink($request, $sorter->getOrder());
        $this->viewData['perPageSelector']  = $perPageSelector;
        $this->viewData['perPage']          = $perPage;
        $this->viewData['paginator']        = $this->getGroupsWithPaginate($filter, $sorter, $perPage);

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['group'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->viewData['group'] = $model;

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
     * @param GroupFilter $filter
     * @param GroupSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    private function getGroupsWithPaginate(
        GroupFilter $filter,
        GroupSorter $sorter,
        int $perPage
    ): mixed {
        return $this->repository->getAllWithPaginate($filter, $sorter, $perPage);
    }
}
