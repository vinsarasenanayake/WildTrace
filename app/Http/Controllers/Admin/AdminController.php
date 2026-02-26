<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Milestone;
use App\Models\Photographer;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
    public function photographers()
    {
        return view('admin.pages.photographers.index');
    }

    public function photographersCreate()
    {
        return view('admin.pages.photographers.create');
    }

    public function photographersEdit(Photographer $photographer)
    {
        return view('admin.pages.photographers.edit', compact('photographer'));
    }

    public function users()
    {
        return view('admin.pages.users.index');
    }


    public function orders()
    {
        return view('admin.pages.orders.index');
    }

    public function milestones()
    {
        return view('admin.pages.milestones.index');
    }

    public function milestonesCreate()
    {
        return view('admin.pages.milestones.create');
    }

    public function milestonesEdit(Milestone $milestone)
    {
        return view('admin.pages.milestones.edit', compact('milestone'));
    }
}
