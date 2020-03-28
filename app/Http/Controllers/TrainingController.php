<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    
    public function add(){
        
    }
    
    //-----------------
    // 新規投稿
    //-----------------
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
    //------------------
    // 投稿の更新
    //------------------
    public function update(Request $request){
        
        $this->validate($request, Training::$rules);
        $form = $request->all();
        $training_update = Training::where(id, $request->id)->get();
        
        $training_update->body = $form['body'];
        $training_update->save();
        
        return redirect('/training/home');
    }
    
    public function destroy(){
        
    }
    
    public function training_list(){
        
    }
}
