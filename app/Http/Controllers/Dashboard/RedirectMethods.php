<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;

trait RedirectMethods
{
    /**
     * @param string $msg
     * @return RedirectResponse
     */
    protected function backWithErrors(string $msg = ''): RedirectResponse
    {
        return back()->withErrors(['msg' => $msg]);
    }

    /**
     * @param array $errors
     * @return RedirectResponse
     */
    protected function backWithErrorsAndInput(array $errors): RedirectResponse
    {
        $errors = !empty($errors) ? $errors : [self::$msgSaveError];

        return back()->withErrors($errors)->withInput();
    }

    /**
     * @param string $route
     * @param array $parameter
     * @return RedirectResponse
     */
    protected function redirectToRoute(string $route, array $parameter = []): RedirectResponse
    {
        return redirect()->route($route, $parameter);
    }

    /**
     * @param int $id
     * @return string
     */
    protected function successDestroyMessage(int $id): string
    {
        return 'Запись с id = ' . $id . ' успешно удалена';
    }

    /**
     * @return RedirectResponse
     */
    protected function redirectWhenStoreSuccess(): RedirectResponse
    {
        return $this->redirectToRoute($this->routeNames->index())
            ->with(['success' => self::$msgSaveSuccess]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    protected function redirectWhenUpdateSuccess(int $id): RedirectResponse
    {
        return $this->redirectToRoute($this->routeNames->edit(), [$id])
            ->with(['success' => self::$msgSaveSuccess]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    protected function redirectWhenDestroySuccess(int $id): RedirectResponse
    {
        return $this->redirectToRoute($this->routeNames->index())
            ->with(['success' => $this->successDestroyMessage($id)]);
    }
}
