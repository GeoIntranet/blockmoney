<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recursive extends Model
{
    protected $table ='recursives';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
