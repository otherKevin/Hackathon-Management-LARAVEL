<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /* Lister un event */

    public function index()
    {
        $events = Event::all();

        return response()->json(["events" => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /* Création d'un event */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string',
            'location' => 'required|string'
        ]);

        $event = Event::create([
            'name' => $request->name,
            'start' => $request->start,
            'end' => $request->end,
            'location' => $request->location,
        ]);

        return response()->json(['message' => 'Evènement créé', 'event' => $event], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        /*         $event = Event::find($event_id);
        return response()->json(['message' => '', 'event' => $event], 200); */

        $event = Event::find($event_id);
        $users = Event::find($event_id)->users()->orderBy('firstname')->get();
        foreach ($users as $user) {
            $user->role = $user->roles()->where("event_id", $event_id)->first();
            if (!isset($user->role)) {
                $user->role = ["Authorization" => null, "event_id" => $event_id, "user_id" => $user->id];
            }
        }

        return response()->json(['message' => 'Affichage du groupe', 'event' => $event, 'users' => $users], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'start' => 'required|string',
                'end' => 'required|string',
                'location' => 'required|string',

            ]
        );

        $event = Event::findOrFail($id);

        $event->name = $request->input('name');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->location = $request->input('location');

        $event->save();

        return response()->json(['message' => 'Evénement Modifié', 'event' => $event], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Evénement Supprimé'], 200);
    }
}
