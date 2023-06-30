<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaunchRequest;
use App\Http\Resources\LaunchListResource;
use App\Http\Resources\LaunchResource;
use App\Models\Launch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaunchController extends Controller
{
    public function index(Request $request)
    {
        $launchers = Launch::with([
            'provider:id,name', 'rocket:id,name',
        ])->paginate($request->per_page ?? 10);

        return LaunchListResource::collection($launchers);
    }

    public function store(LaunchRequest $request): LaunchResource
    {
        $data = $request->safe()->all();
        $data['slug'] = Str::slug($data['name']);

        $launch = Launch::create($data);
        return new LaunchResource($launch);
    }

    public function show(Launch $launch): LaunchResource
    {
        $launch->load(['provider', 'rocket']);
        return new LaunchResource($launch);
    }

    public function update(LaunchRequest $request, Launch $launch): LaunchResource
    {
        $launch->update($request->safe()->all());
        return new LaunchResource($launch);
    }

    public function destroy(Launch $launch)
    {
        $launch->delete();
    }
}
