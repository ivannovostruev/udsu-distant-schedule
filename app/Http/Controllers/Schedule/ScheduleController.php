<?php

namespace App\Http\Controllers\Schedule;

use App\DataCollectors\ScheduleDataCollector;
use App\Http\Controllers\Controller;
use App\Support\Abilities\ScheduleAbilities;
use App\Support\ViewNames\ScheduleViewNames;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleDataCollector
     */
    protected ScheduleDataCollector $dataCollector;

    public function __construct(ScheduleDataCollector $dataCollector)
    {
        $this->dataCollector = $dataCollector;
    }

    /**
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize($this->getIndexAbility());
        return $this->getIndexView($request);
    }

    /**
     * @param Request|null $request
     * @return Application|Factory|View
     */
    protected function getIndexView(?Request $request = null)
    {
        return view($this->getIndexViewName(), $this->getGridViewData($request));
    }

    /**
     * @return string
     */
    protected function getIndexAbility(): string
    {
        return ScheduleAbilities::INDEX;
    }

    /**
     * @return string
     */
    protected function getIndexViewName(): string
    {
        return ScheduleViewNames::GRID;
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function getGridViewData(Request $request): array
    {
        return $this->dataCollector->getGridViewData($request);
    }
}
