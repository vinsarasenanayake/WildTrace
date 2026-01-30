<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home page
    public function home()
    {
        return view('pages.home');
    }

    // Journey page
    public function journey()
    {
        return view('pages.journey');
    }

    // Gallery page
    public function gallery()
    {
        return view('pages.gallery');
    }

    // Product page
    public function product($id)
    {
        return view('pages.product-show', compact('id'));
    }
}
