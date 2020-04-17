<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function training()
    {
        return $this->hasMany('App\Models\Training');
    }
    
    //中間テーブル
    public function trainings()
    {
        return $this->belongsToMany('App\Models\Training', 'comments')->withPivot('body');
    }
    
    public function favorite_trainings()
    {
        return $this->belongsToMany('App\Models\Training', 'favorites', 'user_id', 'training_id');
    }
    
    // favoritesが存在するか確認する
    public function exist_favo($trainingId) {
        
        // wherePivotを使った方が中間テーブルでフィルタリングしているイメージがしやすいのでこれをつかっている
        $exist = $this->favorite_trainings()->wherePivot('training_id', $trainingId)->exists();
        // dd($exist);
        if($exist){
            return true;
        }else{
            return false;
        }
        
    }
}
