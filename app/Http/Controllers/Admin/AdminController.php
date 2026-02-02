<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display the main administrative dashboard overview
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
    // Manage the list of contributing photographers
    public function photographers()
    {
        return view('admin.pages.photographers.index');
    }

    // Launch the interface for registering a new photographer
    public function photographersCreate()
    {
        return view('admin.pages.photographers.create');
    }

    // Modify existing photographer profiles and details
    public function photographersEdit($photographer)
    {
        return view('admin.pages.photographers.edit', compact('photographer'));
    }

    // Review and manage registered user accounts
    public function users()
    {
        return view('admin.pages.users.index');
    }

    // Monitor and handle newsletter subscriber lists
    public function subscribers()
    {
        return view('admin.pages.subscribers.index');
    }

    // Orchestrate and track customer order fulfillment
    public function orders()
    {
        return view('admin.pages.orders.index');
    }

    // Maintain the project's historical milestones timeline
    public function milestones()
    {
        return view('admin.pages.milestones.index');
    }

    // Define a new historical achievement for the company
    public function milestonesCreate()
    {
        return view('admin.pages.milestones.create');
    }

    // Update the details of a specific timeline event
    public function milestonesEdit($milestone)
    {
        return view('admin.pages.milestones.edit', compact('milestone'));
    }
}
