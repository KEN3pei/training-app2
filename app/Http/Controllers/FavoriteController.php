<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;

class FavoriteController extends Controller
{
        // 追加する
        public function attach() {
            
            $trainingId = $_GET['id'];
            // dd($trainingId);
            Auth::user()->favorite_trainings()->attach($trainingId);
            
            return back();
        }
        // 削除する
        public function detach() {
            
            $trainingId = $_GET['id'];
            // dd($trainingId);
            Auth::user()->favorite_trainings()->detach($trainingId);
            
            return back();
        }
        
        // 1投稿あたりのいいねの数
        public function count_favorites($trainingId) {
            
            // dd($trainingId);
            $users = $trainingId->favorite_users;
            dd($users);
            $count = count($users);
            // dd($count);
            return $count;
        }
        
}
