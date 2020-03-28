<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    
    public function add(){
        
    }
    
    public function create(Request $request){
        
        $this->validate($request, Training::$rules);
        $training = new Training;
    
        $form = $request->all();
        $auth_user = Auth::user();
        $createtime = Carbon::now();
        
        $training->body = $form['body'];
        $training->user_id = $auth_user;
        $training->date = $createtime;
        $training->save();
        
        return redirect('/training/home');
    }
    
    public function update(Request $request){
        
        
    }
    
    public function destroy(){
        
    }
    
    public function training_list(){
        
    }
}
