<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Sponsor;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $teams = Team::with('sponsor')
            ->get();


        return view('admin.team.index')->with('teams', $teams);
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Gets an array of all players
        /* $players = Player::all();*/
        $sponsors = Sponsor::all();

        return view('admin.team.create')->with('sponsors', $sponsors); /*->with('players', $players)*/;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function tournament()
    // {
    //     return $this->belongsTo(Tournament::class);
    // }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sponsor_id' => 'required',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'sponsor_id' => $request->sponsor_id,
            'user_id' => Auth::id()
        ]);

        return to_route('admin.team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        if (!Auth::id()) {
            return abort(403);
        }


        return view('admin.team.show')->with('team', $team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //If user is not an authorized user they can not edit existing tournaments
        if ($team->user_id != Auth::id()) {
            return abort(403);
        }
        $sponsors = Sponsor::all();


        // get all teams from db
        /*$players = Player::all();*/
        // ->with( all teams ) 
        //Returns the edit.blade.php page with an array of teams
        return view('admin.team.edit')->with('team', $team)->with('sponsors', $sponsors);
            /*->with('players', $player)*/;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        if ($team->user_id != Auth::id()) {
            return abort(403);
        }
        //Makes sure everything is filled in from user
        $request->validate([
            'name' => 'required',
            'sponsor_id' => 'required',

        ]);
        //Updates with the validated entries
        $team->update([
            'name' => $request->name,
            'sponsor_id' => $request->sponsor_id
        ]);
        return to_route('admin.team.show', $team->id)->with('success', 'team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $team->delete();

        return to_route('admin.team.index')->with('success', 'Team deleted successfully');
    }
}