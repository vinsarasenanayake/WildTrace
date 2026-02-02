<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Serve the main landing page of the application
    public function home()
    {
        return view('pages.home');
    }

    // Display the brand story and timeline page
    public function journey()
    {
        return view('pages.journey');
    }

    // Show the gallery grid of all products
    public function gallery()
    {
        return view('pages.gallery');
    }

    // Render the detailed view for a specific product
    public function product($id)
    {
        return view('pages.product-show', compact('id'));
    }
}
