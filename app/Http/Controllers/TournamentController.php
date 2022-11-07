<?php

namespace App\Http\Controllers;

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
         $tournaments = Tournament::where('user_id', Auth::id())->latest('updated_at')->paginate(4);
         return view('tournament.index')->with('tournaments', $tournaments);
        // return view('tournament.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();

     return view('tournament.create')->with('teams', $teams);
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
            'name'=>'required',
            'location'=>'required',
            'description'=>'required|max:100',
            'start_date'=>'required' ,
             'team_id'=>'required' ,
        ]);

        Tournament::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'team_id' => $request->team_id,
            'user_id' => Auth::id()
        ]);

        return to_route('tournament.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $players = Player::all();
        $tournament = Tournament:: where('id', $id)->firstOrFail();
        return view('tournament.show')-> with('tournament', $tournament)->with('players', $players);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        if($tournament->user_id != Auth::id()){
            return abort(403);
        }

        
        // get all teams from db
        $teams = Team::all();
        // ->with( all teams ) 
        
        return view('tournament.edit')-> with ('tournament', $tournament)->with ('teams', $teams);
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
        if($tournament->user_id != Auth::id()){
            return abort(403);
        }
        //Makes sure everything is filled in from user
        $request->validate([
            'name'=> 'required',
            'location'=> 'required',
            'description'=> 'required',
            'start_date'=> 'required',
            'team_id'=> 'required',

        ]);
        //Updates with the validated entries
        $tournament->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'team_id' => $request->team_id,
        ]);
        return to_route('tournament.index', $tournament->id)->with('success', 'Tournament updated successfully');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        if($tournament->user_id != Auth::id()){
            return abort(403);
        }

        $tournament->delete();

        return to_route('tournament.index')->with('success', 'Tournament deleted successfully');
    }
}
