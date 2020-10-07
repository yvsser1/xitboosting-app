<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    protected $table = 'divisions';

    protected $fillable = ['name','league_id','photo_id'];

    public function photo()
    {

        return $this->belongsTo('App\Photo');

    }

    public function league()
    {

        return $this->belongsTo('App\Leagues');

    }

}
