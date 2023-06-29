<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaunchListResource;
use App\Http\Resources\LaunchResource;
use App\Models\Launch;
use Illuminate\Http\Request;

class LaunchController extends Controller
{
    public function index(Request $request)
    {
        $launchers = Launch::with([
            'provider:id,name', 'rocket:id,name',
        ])->paginate($request->per_page ?? 10);

        return LaunchListResource::collection($launchers);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Launch $launch): LaunchResource
    {
        $launch->load(['provider', 'rocket']);
        return new LaunchResource($launch);
    }

    public function update(Request $request, Launch $launch)
    {
        //
    }

    public function destroy(Launch $launch)
    {
        //
    }
}
