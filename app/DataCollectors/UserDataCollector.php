<?php

namespace App\DataCollectors;

use App\Models\Role;
use App\QueryFilters\UserFilter;
use App\Repositories\UserRepository;
use App\Sorters\UserSorter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property UserRepository $repository
 */
class UserDataCollector extends BaseDataCollector
{
    use SortLinkGetter;

    /**
     * @param Request $request
     * @return UserFilter
     */
    protected function getFilter(Request $request): UserFilter
    {
        return new UserFilter($request);
    }

    /**
     * @param Request $request
     * @return UserSorter
     */
    protected function getSorter(Request $request): UserSorter
    {
        return new UserSorter($request);
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

        $this->viewData['roles']            = Role::all();
        $this->viewData['sortLink']         = $this->getSortLink($request, $sorter->getOrder());
        $this->viewData['perPageSelector']  = $perPageSelector;
        $this->viewData['perPage']          = $perPage;
        $this->viewData['paginator']        = $this->getUsersWithPaginate($filter, $sorter, $perPage);

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['user'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->viewData['user'] = $model;
        $this->viewData['roles'] = Role::all();

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
     * @param Request $request
     * @return array
     */
    public function getStoreData(Request $request): array
    {
        $data = $request->input();

        $data['password'] = $this->determinePassword($data);
        $data['role_id']  = $this->determineRoleId($data);

        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUpdateData(Request $request): array
    {
        $data = $request->input();

        $data['role_id'] = $this->determineRoleId($data);

        return $data;
    }

    /**
     * @param UserFilter $filter
     * @param UserSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    private function getUsersWithPaginate(
        UserFilter $filter,
        UserSorter $sorter,
        int $perPage
    ): mixed {
        return $this->repository->getAllWithPaginate($filter, $sorter, $perPage);
    }

    /**
     * @param array $data
     * @return string
     */
    private function determinePassword(array $data): string
    {
        return bcrypt($data['password']);
    }

    /**
     * @param array $data
     * @return int|null
     */
    private function determineRoleId(array $data): ?int
    {
        $defaultRole = 'no';

        $roleId = $data['role_id'] ?? null;

        return is_null($roleId) || $roleId === $defaultRole
            ? null
            : (int) $roleId;
    }
}
