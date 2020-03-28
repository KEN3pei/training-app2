<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    
    protected $fillable = [
        'body', 'date', 'user_id',
    ];
    
    public static $rules = array(
        'body' => 'required',
    );
}
