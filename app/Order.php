<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'paypal_id',
        'type',
        'service',
        'line',
        'rank',
        'server_id',
        'hours',
        'now_league_id',
        'now_division_id',
        'next_league_id',
        'next_division_id',
        'queue_id',
        'game_service',
        'games',
        'price',
        'pay_status',
        'status'
    ];

    public function cleague()
    {

        return $this->belongsTo('App\Leagues','now_league_id');

    }

    public function nleague()
    {

        return $this->belongsTo('App\Leagues','next_league_id');

    }

    public function cdivision()
    {

        return $this->belongsTo('App\Division','now_division_id');

    }

    public function ndivision()
    {

        return $this->belongsTo('App\Division','next_division_id');

    }

    public function server()
    {

        return $this->belongsTo('App\Server');

    }

    public function queue()
    {

        return $this->belongsTo('App\Queue');

    }

    public function user()
    {

        return $this->belongsTo('App\User');

    }
}
