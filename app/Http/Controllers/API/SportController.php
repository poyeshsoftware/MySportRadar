<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SportRequest;
use App\Http\Resources\SportResource;
use App\Sport;


class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SportResource::collection(Sport::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportRequest $request)
    {
        return Sport::create($request->only('name'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Sport $sport, SportRequest $request)
    {
        return $sport->update($request->only('name'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        return $sport->delete();
    }

}
