<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_user = User::all();
        // dd($all_user);
        
        return view('admin_auth.home', ['users' => $all_user]);
    }
    
    public function delete(Request $request) 
    {
        // dd($request->id);
        $user = User::find($request->id);
        // dd($user);
        $comments = $user->trainings;
        foreach($comments as $comment){
            $pivot = $comment->pivot;
            $pivot->delete();
        }
        $trainings = $user->training;
        foreach($trainings as $training){
            $training->delete();
        }
        $user->delete();

        return back();
    }
    
}
