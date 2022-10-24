<?php

namespace App\Http\Controllers;

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
        $tournament = Tournament::paginate(6);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Tournament::create([
            'name'=>$request->name,
            'location'=>$request->location,
            'description'=>$request->description,
            'date'=>$request->date

        ]);
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
            'start_date'=>'required'
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
        $tournament = Tournament:: where('id', $id)-> where('id', Auth::id())->firstOrFail();
        return view('index')-> with('tournament', $tournament);
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
        return view('tournament.edit')-> with ('tournament', $tournament);
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
    public function destroy(Tournament $tournament)
    {
        if($tournament->id != Auth::id()){
            return abort(403);
        }

        $tournament->delete();

        return to_route('notes.index')->with('success', 'Note deleted successfully');
    }
}
