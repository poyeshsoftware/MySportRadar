<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventFilterRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\TheEvent;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(EventFilterRequest $request)
    {
        return EventResource::collection(TheEvent::withFilters());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        return TheEvent::create([
            'date' => $request->date,
            '_sport_id' => $request->_sport_id,
            '_team_id_1' => $request->_team_id_1,
            '_team_id_2' => $request->_team_id_2,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TheEvent $theEvent, EventRequest $request)
    {
        return $theEvent->update($request->validated());
    }

    public function destroy(TheEvent $theEvent)
    {
        return $theEvent->delete();
    }
}
