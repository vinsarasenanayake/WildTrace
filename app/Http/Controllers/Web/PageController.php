<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function journey()
    {
        return view('pages.journey');
    }

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function product($id)
    {
        return view('pages.product-show', compact('id'));
    }
}
