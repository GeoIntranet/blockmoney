<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recursive extends Model
{
    protected $table ='recursives';

    protected $fillable = [
        'actegorie_id',
        'user_id',
        'name',
        'action',
        'value',
        'active',
        'date',
        'expire',
        'periode',
        'account_id',
        'readable_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
