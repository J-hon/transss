<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'narration', 'amount', 'type', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
