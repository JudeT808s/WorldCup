<?php

namespace App\Http\Controllers\user;

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
        $user->authorizeRoles('user');
        //Displays tournaments that the user has made by recency
        $tournaments = Tournament::where('user_id', Auth::id())->latest('updated_at')->paginate(4);


        return view('user.tournament.index')->with('tournaments', $tournaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');
        //Gets an array of all players
        $players = Player::all();

        //prints tournaments unless the first tournament is not found and gives an error
        $tournament = Tournament::where('id', $id)->firstOrFail();
        //Shows tournament by getting tournament_id and prints alongside array of players
        return view('user.tournament.show')->with('tournament', $tournament)->with('players', $players);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}