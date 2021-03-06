<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Training;

class CommentController extends Controller
{
    public function add() {
        
        $get = $_GET['id'];
        $training = Training::find($get);
        $v = $training->users;
        // dd($v);
        if(count($v) == 0){
            $comments = null;
        }else{
            foreach($training->users as $user){
                $comments[] = $user->pivot->body;
            }
        }
        // dd($training->user);
        
        return view('comment_list', ['training' => $training, 'comments' => $comments]);
    }
    
    // -------------------------
    // コメント画面表示
    // -------------------------
    public function index() {
        
        $get = $_GET['id'];
        $training = Training::find($get);
        $comments = $this->all_comment($get);
        $auth = Auth::user();
        // dd($comments);
        
        return view('comment', ['training' => $training, 'comments' => $comments, 'auth' => $auth]);
    }
    // -------------------------
    // コメント作成機能
    // -------------------------
    public function create(Request $request) {
        
        $this->validate($request, Comment::$rules);
        $body = $request->body;
        $user_id = Auth::user()->id;
        $training_id = $request->id;
        // dd($training_id);
        $comment = new Comment;
        // dd($comment);
        $comment->fill([
            'body' => $body,
            'user_id' => $user_id,
            'training_id' => $training_id,
        ]);
        // dd($comment);
        $comment->timestamps = false;
        $comment->save();
        
        return back();
    }
    
    // -------------------------------
    // コメント一覧表示
    // -------------------------------
    public function all_comment($get) {
        
        $comments = Comment::where('training_id', $get)->get();
        
        return $comments;
    }
    
    //---------------------------------
    // コメント削除
    // --------------------------------
    public function delete(Request $request) {
        
        $comment = Comment::find($request->id);
        $comment->delete();
        // dd($comment);
        
        return back();
    }
    
}
