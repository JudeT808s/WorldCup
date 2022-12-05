<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {

        $user = Auth::user();
        $home = 'home';

        if ($user->hasRole('admin')) {
            $home = 'admin.tournament.index';
        } else if ($user->hasRole('user')) {
            $home = 'user.tournament.index';
        }
        return redirect()->route($home);
    }

    public function teamIndex(Request $request)
    {

        $user = Auth::user();
        $home = 'home';

        if ($user->hasRole('admin')) {
            $home = 'admin.team.index';
        } else if ($user->hasRole('user')) {
            $home = 'user.team.index';
        }
        return redirect()->route($home);
    }
}