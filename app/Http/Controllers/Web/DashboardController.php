<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Display the personalized user control panel
    public function index()
    {
        return view('pages.user.dashboard');
    }
}
