<?php

namespace App\Http\Middleware;

use App\DataCollectors\DataCollector;
use App\Repositories\NotificationRepository;
use Auth;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminNotifications
{
    /**
     * @var DataCollector
     */
    protected DataCollector $dataCollector;

    /**
     * @param DataCollector $dataCollector
     */
    public function __construct(DataCollector $dataCollector)
    {
        $this->dataCollector = $dataCollector;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $notifications = $this->getNotifications(Auth::id());
        $this->dataCollector->addNotificationsInViewData($notifications);

        return $next($request);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    protected function getNotifications(int $userId): Collection
    {
        return (new NotificationRepository())->getByUserId($userId);
    }
}
