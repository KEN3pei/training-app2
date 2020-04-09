<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Training extends Model
{
    
    protected $fillable = [
        'body', 'date', 'user_id',
    ];
    
    public static $rules = array(
        'body' => 'required',
    );
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    //中間テーブル
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'comments')->withPivot('body');
    }
}
