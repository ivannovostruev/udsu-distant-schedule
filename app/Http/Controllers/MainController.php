<?php

namespace App\Http\Controllers;

use App\Support\RouteNames\LessonRouteNames;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(): View|Factory|RedirectResponse|Application
    {
        return Auth::check()
            ? redirect()->route(LessonRouteNames::INDEX)
            : view('main');
    }

    /**
     * @return View|Factory|Application
     */
    public function home(): View|Factory|Application
    {
        return view('home');
    }
}
