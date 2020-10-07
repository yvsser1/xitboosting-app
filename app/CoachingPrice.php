<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachingPrice extends Model
{
    protected $table = 'coaching_prices';

    protected $fillable = ['price','hours', 'rank'];
}
