<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographerController extends Controller
{
    public function index()
    {
        $photographers = Photographer::all();

        $photographers->transform(function ($photographer) {
            if ($photographer->image) {
                $photographer->image_url = asset('storage/' . $photographer->image);
            }
            return $photographer;
        });

        return response()->json(['data' => $photographers]);
    }

    public function show($id)
    {
        $photographer = Photographer::find($id);

        if (!$photographer) {
            return response()->json(['message' => 'Photographer not found'], 404);
        }

        if ($photographer->image) {
            $photographer->image_url = asset('storage/' . $photographer->image);
        }

        return response()->json($photographer);
    }
}
