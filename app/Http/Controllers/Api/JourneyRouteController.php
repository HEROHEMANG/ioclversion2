<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JourneyRoute;
use Illuminate\Http\Request;

class JourneyRouteController extends Controller
{
    public function index()
    {
        return JourneyRoute::select('id', 'name', 'source', 'destination')->orderBy('name')->get();
    }

    public function show(JourneyRoute $journeyRoute)
    {
        return $journeyRoute;
    }
}


