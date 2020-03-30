<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use App\Models\User;
use Carbon\Carbon;

class TrainingController extends Controller
{
    
    public function add(){
        
        $auth = Auth::user();
        $image = md5( strtolower( trim( "kensuke1202left@icloud.com " )));
        $trainings = $this->index();
        // dd($trainings);
        return view('home', ['image' => $image, 'auth' => $auth, 'trainings' => $trainings]);
    }
    
    //-----------------
    // 新規投稿
    //-----------------
    public function create(Request $request){
        
        if($request->new_training == null){
            return redirect()->back();
        }
        $training = new Training;
        // dd($request->new_training);
        $new_training = $request->new_training;
        $auth_user_id = Auth::user()->id;
        $createtime = Carbon::now();
        // dd($createtime);
        $training->body = $new_training;
        $training->user_id = $auth_user_id;
        $training->date = $createtime;
        $training->timestamps = false;
        $training->save();
        
        return redirect('/home');
    }
    //------------------
    // 投稿の編集
    //------------------
    public function edit(Request $request){
        
        $this->validate($request, Training::$rules);
        $form = $request->all();
        $training_update = Training::where(id, $request->id)->get();
        
        $training_update->body = $form['body'];
        $training_update->save();
        
        return redirect('/training/home');
    }
    //-----------------
    // 投稿の削除
    //-----------------
    public function destroy(Request $request){
        
        $training = Training::find($request->id);
        $training->delete();
        
        return redirect('/training/home');
    }
    //------------------
    // 投稿の一覧を表示
    //------------------
    public function index(){
        
        $trainings = Training::orderBy('date', 'desc')->get();
        
        return $trainings;
    }
}
