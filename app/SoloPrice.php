<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoloPrice extends Model
{
    protected $table = 'solo_prices';

    protected $fillable = ['price', 'now_league_id', 'now_division_id', 'next_league_id', 'next_division_id'];

    public function nowLeagues(){
        return $this->belongsTo('App\Leagues','now_league_id');
    }

    public function nowDivisions(){
        return $this->belongsTo('App\Division','now_division_id');
    }

    public function nextLeagues(){
        return $this->belongsTo('App\Leagues','next_league_id');
    }

    public function nextDivisions(){
        return $this->belongsTo('App\Division','next_division_id');
    }
}
