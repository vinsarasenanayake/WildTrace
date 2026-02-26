<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::orderBy('year', 'desc')->get();
        return response()->json(['data' => $milestones]);
    }
}
