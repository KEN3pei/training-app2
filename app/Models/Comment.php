<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $fillable = [
        'body', 'user_id', 'training_id',
    ];
    
    public static $rules = array(
        'body' => 'required',
    );
    
    // public function users()
    // {
    //     return $this->belongsToMany('App\Models\User');
    // }
}
