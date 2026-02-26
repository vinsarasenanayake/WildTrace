<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        $previousUrl = url()->previous();
        $path = parse_url($previousUrl, PHP_URL_PATH);

        $redirectPaths = ['/cart', '/checkout', '/shipping', '/dashboard', '/user/profile'];

        foreach ($redirectPaths as $restrictedPath) {
            if (str_contains($path, $restrictedPath)) {
                return redirect('/');
            }
        }

        return redirect()->to($previousUrl);
    }
}
