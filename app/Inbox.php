<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{

    protected $table = 'inboxs';

    protected $fillable = ['subject','email','description'];

}
