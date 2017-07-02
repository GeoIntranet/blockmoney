<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soldes extends Model
{
    protected $fillable=['value','account_id','user_id'];

    public function scopeLastSolde($query,$user,$account)
    {
        return $query
            ->where('user_id',$user)
            ->where('account_id',$account)
            ->orderBy('created_at','DESC')
            ->limit(0)
            ->take(1)
            ;
    }
}
