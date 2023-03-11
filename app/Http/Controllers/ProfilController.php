<?php

namespace App\Http\Controllers;

use App\Models\Abilities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->abilities;
        return response()->json(['message' => '', 'user' => $user], 200);
    }

    public function showOwn()
    {
        $user = Auth::user();
        return response()->json(['message' => 'User récupéré', 'user' => $user], 200);
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
    public function update(Request $request)
    {

        $request->validate(
            [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|string',
                'password' => 'string|nullable',
                'linkedIn' => 'string|nullable',
                'github' => 'string|nullable',
                'website' => 'string|nullable',
                'portfolio' => 'string|nullable',
                'bio' => 'string|nullable',
                // 'picture' => 'required|string',

            ]
        );

        $user = Auth::user();

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->linkedIn = $request->input('linkedIn');
        $user->github = $request->input('github');
        $user->website = $request->input('website');
        $user->portfolio = $request->input('portfolio');
        $user->bio = $request->input('bio');
        // $user->picture = $request->input('picture');

        if (isset($request->password)) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return response()->json(['message' => 'Profil modifié', 'user' => $user], 200);
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
