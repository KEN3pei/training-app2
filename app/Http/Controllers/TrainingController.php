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
        $auth_email = $auth->email;
        $image = md5( strtolower( trim( "$auth_email " )));
        $trainings = $this->index();
        
        $today = substr(Carbon::today(), 0, 10);
        $auth_training = Training::where("user_id", $auth->id)->where("date", 'LIKE', "%{$today}%")->first();
        // dd($auth_training);
        // image = Gravatarの自分のimage
        // auth_training = ログインユーザーの最新の投稿
        // trainings = 全ての投稿を降順に並べたもの
        // auth = ログインユーザーの情報
        return view('home', ['image' => $image, 'auth_training' => $auth_training, 'trainings' => $trainings, 'auth' => $auth]);
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
        // dd($request->id);
        $form = $request->body;
        $training_update = Training::find($request->id);
        // dd($training);
        $training_update->body = $form;
        $training_update->timestamps = false;
        $training_update->save();
        
        return redirect('/home');
    }
    //-----------------
    // 投稿の削除
    //-----------------
    public function delete(Request $request){
        
        $training = Training::find($request->id);
        $training->delete();
        
        return redirect('/home');
    }
    
    //------------------
    // 投稿の一覧を表示
    //------------------
    public function index(){
        //日付で降順に並び変えている
        $trainings = Training::orderBy('date', 'desc')->get();
        // dd($count);
        return $trainings;
    }
    
}
