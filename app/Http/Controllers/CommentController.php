<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Training;

class CommentController extends Controller
{
    public function add() {
        
        return view('comment_list');
    }
    
    public function index() {
        
        $get = $_GET['id'];
        $training = Training::find($get);
        // dd($training);
        
        return view('comment', ['training' => $training]);
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
    
}
