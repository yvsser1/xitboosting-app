<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WinPrice extends Model
{
    protected $table = 'win_prices';

    protected $fillable = ['price', 'now_league_id', 'now_division_id', 'games'];

    public function nowLeagues(){
        return $this->belongsTo('App\Leagues','now_league_id');
    }

    public function nowDivisions(){
        return $this->belongsTo('App\Division','now_division_id');
    }
}
