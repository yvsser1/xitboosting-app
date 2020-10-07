<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $table = 'service_prices';

    protected $fillable = ['price', 'service'];
}
