<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'post_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
