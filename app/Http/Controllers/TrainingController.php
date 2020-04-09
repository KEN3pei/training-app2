<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use App\Models\User;
use App\Models\Comment;
use Carbon\Carbon;
use App\Http\Controllers\CalendarController;

class TrainingController extends Controller
{
    // -----------------
    // ログイン時に表示するもの
    //------------------
    public function add(){
        
        // $user = User::find(1)->trainings;
        // // foreach ($user->trainings as $training) {
        // //     dd($training);
        // // }
        // dd($user);
        
        $calendar_c = app()->make('App\Http\Controllers\CalendarController');
        $month = $calendar_c->getMonth();
        $weeks = $calendar_c->calendar($month);
        $auth = Auth::user();
        $auth_email = $auth->email;
        $image = md5( strtolower( trim( "$auth_email " )));
        
        $trainings = $this->index();
        $auth_training = $this->get_today_training($month);
        
        $now = substr(Carbon::now(), 0, 7);
        // dd($now);
        //様々な値を表示させようとするとviewに渡す変数が増えてしまい整理できない
        return view('home', [
            'image' => $image, 
            'auth_training' => $auth_training, 
            'trainings' => $trainings, 
            'auth' => $auth,
            'month' => $month,
            'weeks' => $weeks,
            'now' => $now
            ]);
    }
    
    // ----------------------
    // カレンダーの日付ごとの投稿を取得
    // ----------------------
    public function get_today_training($month) {
        
        if(isset($_GET['today'])){
            $today = $_GET['today'];
        }else{
            $today = substr(Carbon::today(), 0, 10);
        }
        $auth = Auth::user();
        $auth_training = Training::where("user_id", $auth->id)->where("date", 'LIKE', "%{$today}%")->first();
        
        return $auth_training;
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
        // カリキュラムではfillを使ってから保存しているがそれが適切なのかわからないため直接代入している
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
        $comments = Comment::where("training_id", $request->id)->get();
        foreach($comments as $comment){
            $comment->delete();
        }
        // dd($comments);
        return redirect('/home');
    }
    
    //------------------
    // 投稿の一覧を表示
    //------------------
    public function index(){
        
        $trainings = Training::orderBy('date', 'desc')->get();
        // dd($count);
        return $trainings;
    }
    
}
