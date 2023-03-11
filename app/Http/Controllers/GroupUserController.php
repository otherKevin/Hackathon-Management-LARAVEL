<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * Cette fonction prend le group_id en argument, afin de renvoyer uniquement les participants du groupe spécifique consulté
     */

    // ******************** FONCTION QUI RESTE A ECRIRE / INCOMPLETE
    public function index($group_id)
    {

        /* $group_users_id = GroupUser::where('group_id', $group_id)->get();
        $group_users = User::where('id',); */

        //return response()->json(["userGroupRegistration" => $userGroupRegistration]);
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
        // validate utile ici?? pas de form
        $request->validate([
            'user_id' => 'required|integer',
            'group_id' => 'required|integer',
        ]);

        $grpusers = GroupUser::create([

            'user_id' => $request->user_id,
            'group_id' => $request->group_id,
        ]);

        // 'group-users' => $userAdd @guigui??????????????????????
        return response()->json(['message' => 'Votre participation à été ajoutée', 'group-users' => $grpusers], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    { {
            $add = GroupUser::find($id);
            $add->delete();

            return redirect()->back();
        }
    }
}
