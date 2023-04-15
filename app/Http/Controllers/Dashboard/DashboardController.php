<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Dashboard;
use App\Support\Abilities\DashboardAbilities;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    const VIEW_INDEX = 'dashboard.dashboard';

    public function __construct()
    {
        $this->shareVariablesInView();
    }

    protected function shareVariablesInView(): void
    {
        View::share('dashboard', new Dashboard());
    }

    /**
     * @return Application|Factory|ContractView
     * @throws AuthorizationException
     */
    public function index(): Factory|ContractView|Application
    {
        $this->authorize(DashboardAbilities::INDEX);
        return view(static::VIEW_INDEX);
    }
}
