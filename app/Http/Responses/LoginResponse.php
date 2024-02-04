<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $request->user();
        $role = $user->roles[0]->name;

        switch ($role) {
            case 'admin':
                $route = 'admin.dashboard';
                break;
            case 'user':
                $route = 'user.dashboard';
                break;
            case 'driver':
                $route = 'driver.dashboard';
                break;
            case 'call_center':
                $route = 'call_center.dashboard';
                break;

        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(route($route));
    }
}
