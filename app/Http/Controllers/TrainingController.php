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
        
        $calendar_c = app()->make('App\Http\Controllers\CalendarController');
        $month = $calendar_c->getMonth();
        $weeks = $calendar_c->calendar($month);
        $auth = Auth::user();
        $image = $this->get_image();
        $trainings = $this->index();
        $auth_training = $this->get_today_training($month);
        // dd($training);
        $now = substr(Carbon::now(), 0, 7);
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
        $auth_training = Training::orderBy('date', 'desc')->where("user_id", $auth->id)->where("date", 'LIKE', "%{$today}%")->first();
        
        return $auth_training;
    }
    
    //--------------------------------
    // 各ユーザーのimage取得
    //--------------------------------
    public function get_image() {
        
        $auth = Auth::user();
        if($auth == null){
            return redirect('/');
        }
        $auth_email = $auth->email;
        $image = md5( strtolower( trim( "$auth_email " )));
        
        return $image;
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
        // カリキュラムではfillを使って保存しているがそれが適切なのかわからないため直接代入している
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
    public function delete(Request $request) {
        
        $training = Training::find($request->id);
        $training->delete();
        $comments = Comment::where("training_id", $request->id)->get();
        foreach($comments as $comment){
            $comment->delete();
        }
        // dd($comments);
        return redirect('/home');
    }
    
    // -----------------------
    // 投稿の一覧表示
    // -----------------------
    public function index() {
        
        if(filter_input(INPUT_GET, 'body')){
            $body = $_GET['body'];
            $trainings = Training::where('body', 'LIKE', "%$body%")->get();
        }else{
            $trainings = Training::orderBy('date', 'desc')->get();
        }
        
        return $trainings;
    }
    
    //------------------
    // 投稿の検索
    //------------------
    public function search(Request $request) {
        
        // $this->validate($request, Training::$rules);
        $body = $request->body;
        if($body == null){
            return redirect('/home');
        }
        return redirect('/home?body='."$body");;
    }
    
    
}
