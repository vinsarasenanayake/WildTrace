<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard index
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
    // Photographers index
    public function photographers()
    {
        return view('admin.pages.photographers.index');
    }
    // Create photographer
    public function photographersCreate()
    {
        return view('admin.pages.photographers.create');
    }
    // Edit photographer
    public function photographersEdit($photographer)
    {
        return view('admin.pages.photographers.edit', compact('photographer'));
    }

    // Users index
    public function users()
    {
        return view('admin.pages.users.index');
    }

    // Subscribers index
    public function subscribers()
    {
        return view('admin.pages.subscribers.index');
    }

    // Orders index
    public function orders()
    {
        return view('admin.pages.orders.index');
    }

    // Milestones index
    public function milestones()
    {
        return view('admin.pages.milestones.index');
    }
    // Create milestone
    public function milestonesCreate()
    {
        return view('admin.pages.milestones.create');
    }
    // Edit milestone
    public function milestonesEdit($milestone)
    {
        return view('admin.pages.milestones.edit', compact('milestone'));
    }
}
