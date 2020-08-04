<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TeamResource::collection(Team::with('sports')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        $team = Team::create($request->only('name'));
        $team->sports()->sync($request->sports);
        return response(new TeamResource($team), 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Team $team, TeamRequest $request)
    {
        $team->update($request->only('name'));
        $team->sports()->sync($request->sports);
        return new TeamResource($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        return $team->delete();
    }
}
