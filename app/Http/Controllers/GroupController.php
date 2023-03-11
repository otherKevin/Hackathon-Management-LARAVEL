<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        $groups = Group::where('event_id', $event_id)->get();

        return response()->json(["message" => "Affichage des groupes de l'évenement", "groups" => $groups]);
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
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'name' => 'required|string',
            'room' => 'required|string',
            'members' => 'required|integer',
            'abilities' => 'required|string'


        ]);

        $group = Group::create([
            'subject' => $request->subject,
            'name' => $request->name,
            'room' => $request->room,
            'members' => $request->members,
            'abilities' => $request->abilities,
            'event_id' => $request->event_id
        ]);

        return response()->json(['message' => 'Groupe créé', 'group' => $group], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id)
    {
        $group = Group::find($group_id);
        $group->abilities;

        $users = Group::find($group_id)->users()->orderBy('firstname')->get();


        return response()->json(['message' => 'Affichage du groupe', 'group' => $group, 'users' => $users], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
