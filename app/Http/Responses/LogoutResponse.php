<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    // Create an HTTP response that represents the object
    public function toResponse($request)
    {
        $previousUrl = url()->previous();
        $path = parse_url($previousUrl, PHP_URL_PATH);

        // Paths that require redirection to home (Restricted or Sensitivity)
        // User specifically mentioned "shipping and cart".
        // Assuming shipping is part of checkout flow.
        $redirectPaths = ['/cart', '/checkout', '/shipping', '/dashboard', '/user/profile'];

        foreach ($redirectPaths as $restrictedPath) {
            if (str_contains($path, $restrictedPath)) {
                return redirect('/');
            }
        }

        // For all other pages (Gallery, Journey, Product Pages, Home), stay on the same page.
        return redirect()->to($previousUrl);
    }
}
