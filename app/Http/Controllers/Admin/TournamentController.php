<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
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
        //Displays tournaments that the user has made by recency
        $tournaments = Tournament::where('user_id', Auth::id())->latest('updated_at')->paginate(4);


        return view('admin.tournament.index')->with('tournaments', $tournaments);
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

        //Gets an array of all teams
        $teams = Team::all();

        return view('admin.tournament.create')->with('teams', $teams);
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
            'name' => 'required',
            'location' => 'required',
            'description' => 'required|max:150',
            'start_date' => 'required',
            'team_id' => 'required',
        ]);
        //Fills in user imputed data into database migrations
        Tournament::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'team_id' => $request->team_id,
            'user_id' => Auth::id()
        ]);

        return to_route('admin.tournament.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //Gets an array of all players
        $players = Player::all();

        //prints tournaments unless the first tournament is not found and gives an error
        $tournament = Tournament::where('id', $id)->firstOrFail();
        //Shows tournament by getting tournament_id and prints alongside array of players
        return view('admin.tournament.show')->with('tournament', $tournament)->with('players', $players);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        //If user is not an authorized user they can not edit existing tournaments
        if ($tournament->user_id != Auth::id()) {
            return abort(403);
        }


        // get all teams from db
        $teams = Team::all();
        // ->with( all teams ) 
        //Returns the edit.blade.php page with an array of teams
        return view('admin.tournament.edit')->with('tournament', $tournament)->with('teams', $teams);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        //Checks if the user created the particular tournament or aborts
        if ($tournament->user_id != Auth::id()) {
            return abort(403);
        }
        //Makes sure everything is filled in from user
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'team_id' => 'required',

        ]);
        //Updates with the validated entries
        $tournament->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'team_id' => $request->team_id,
        ]);
        return to_route('admin.tournament.show', $tournament->id)->with('success', 'Tournament updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //Must be authorized user to delete
        if ($tournament->user_id != Auth::id()) {
            return abort(403);
        }

        $tournament->delete();

        return to_route('admin.tournament.index')->with('success', 'Tournament deleted successfully');
    }
}