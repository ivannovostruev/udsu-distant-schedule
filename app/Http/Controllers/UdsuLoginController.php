<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use App\Support\RouteNames\LessonRouteNames;
use App\UdsuServices\UdsuServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UdsuLoginController extends Controller
{
    protected string $redirectTo = '/';

    protected ?BaseRepository $repository = null;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->repository = app(UserRepository::class);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $this->getCredentials($request);

        $udsuUser = UdsuServices::auth($credentials)->user();
        if (!$udsuUser) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route(LessonRouteNames::INDEX));
            }
            return $this->backIfAuthFailed();
        }

        /** @var \App\Models\User $user */
        $user = $this->getUserOnUdsuUser($udsuUser);

        Auth::login($user);

        return $user->isAuthorized()
            ? redirect()->route('home')
            : redirect()->route(LessonRouteNames::INDEX);
    }

    /**
     * @return RedirectResponse
     */
    private function backIfAuthFailed(): RedirectResponse
    {
        return back()->withErrors([
            'username' => 'Предоставленные учетные данные не соответствуют нашим записям.',
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(Request $request): Redirector|RedirectResponse|Application
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getCredentials(Request $request): array
    {
        return $request->validate([
            'username'  => ['required'],
            'password'  => ['required'],
        ]);
    }

    /**
     * @param \App\UdsuServices\User $udsuUser
     * @return mixed
     */
    private function getUserOnUdsuUser(\App\UdsuServices\User $udsuUser): mixed
    {
        $user = $this->getUserByExternalId($udsuUser->getIdNumber());
        if (!$user) {
            $user = User::create($this->getUserData($udsuUser));
        }
        return $user;
    }

    /**
     * @param \App\UdsuServices\User $udsuUser
     * @return array
     */
    private function getUserData(\App\UdsuServices\User $udsuUser): array
    {
        return [
            'external_id'   => $udsuUser->getIdNumber(),
            'name'          => $udsuUser->getName(),
            'email'         => $udsuUser->getEmail(),
            'username'      => $udsuUser->getUsername(),
            'password'      => Hash::make($udsuUser->getPassword()),
            'role_id'       => null,
        ];
    }

    /**
     * @param int $externalId
     * @return mixed
     */
    private function getUserByExternalId(int $externalId): mixed
    {
        return $this->repository->getByExternalId($externalId);
    }
}
