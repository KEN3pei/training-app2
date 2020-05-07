<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function profile() {
        
        $t_controller = app()->make('App\Http\Controllers\TrainingController');
        $image = $t_controller->get_image();
        $trainings = Auth::user()->training;
        // dd($trainings);
        $count = count($trainings);
        
        return view('profile', ['count' => $count, 'image' => $image]);
    }
    
    public function ondeletefrag()
    {
        //まずアラートを出したい
        $user = Auth::user();
        $user->deletefrag = "true";
        $user->save();
        //関連する情報の削除
        //favos はtrainingが消えたら勝手になくなるはず
        $trainings = $user->trainings;
        foreach($trainings as $training){
            // dd($training->pivot);
            $pivots = $training->pivot;
            $pivots->delete();
        }
        // dd($pivots);
        $trainings = $user->training;
        foreach($trainings as $training){
            $training->delete();
        }
        //ログアウトさせる
        
        Auth::logout();
    
        // return redirect('/login');
    }
  
}
