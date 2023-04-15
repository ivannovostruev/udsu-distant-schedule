<?php

namespace App\DataCollectors;

use App\QueryFilters\TeacherFilter;
use App\Repositories\TeacherRepository;
use App\Sorters\TeacherSorter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property TeacherRepository $repository
 */
class TeacherDataCollector extends BaseDataCollector
{
    use StoreAndUpdateDataGetters;
    use SortLinkGetter;

    /**
     * @param Request $request
     * @return TeacherFilter
     */
    protected function getFilter(Request $request): TeacherFilter
    {
        return new TeacherFilter($request);
    }

    /**
     * @param Request $request
     * @return TeacherSorter
     */
    protected function getSorter(Request $request): TeacherSorter
    {
        return new TeacherSorter($request);
    }

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        $filter             = $this->getFilter($request);
        $sorter             = $this->getSorter($request);
        $sortLink           = $this->getSortLink($request, $sorter->getOrder());
        $perPageSelector    = $this->getPerPageSelector($request);
        $perPage            = $perPageSelector->getPerPage();

        $this->viewData['sortLink']         = $sortLink;
        $this->viewData['perPageSelector']  = $perPageSelector;
        $this->viewData['perPage']          = $perPage;
        $this->viewData['paginator']        = $this->getTeachersWithPaginate($filter, $sorter, $perPage);

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['teacher'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->viewData['teacher'] = $model;

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
     * @param TeacherFilter $filter
     * @param TeacherSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    private function getTeachersWithPaginate(
        TeacherFilter $filter,
        TeacherSorter $sorter,
        int $perPage
    ): mixed {
        return $this->repository->getAllWithPaginate($filter, $sorter, $perPage);
    }
}
