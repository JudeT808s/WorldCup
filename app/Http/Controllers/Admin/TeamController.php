<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // $user->authorizeRoles('admin');
        // //Displays tournaments that the user has made by recency
        // $tournaments = Team::where('user_id', Auth::id())->latest('updated_at')->paginate(4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = Auth::user();
        // $user->authorizeRoles('admin');

        // //Gets an array of all players
        // $players = Team::all();

        // return view('admin.tournament.create')->with('players', $players);
    }
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Team::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = team::where('id', $id)->firstOrFail();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //If user is not an authorized user they can not edit existing tournaments
        if ($team->user_id != Auth::id()) {
            return abort(403);
        }


        // get all teams from db
        $teams = Team::all();
        // ->with( all teams ) 
        //Returns the edit.blade.php page with an array of teams
        return view('admin.team.edit')->with('team', $team)->with('players', $player);
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
        if ($tournament->user_id != Auth::id()) {
            return abort(403);
        }
        //Makes sure everything is filled in from user
        $request->validate([
            'name' => 'required',
        ]);
        //Updates with the validated entries
        $tournament->update([
            'name' => $request->name,
        ]);
        return to_route('admin.team.show', $team->id)->with('success', 'team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Must be authorized user to delete
        if ($team->user_id != Auth::id()) {
            return abort(403);
        }

        $team->delete();

        return to_route('admin.tournament.index')->with('success', 'Tournament deleted successfully');
    }
}