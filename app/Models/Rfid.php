<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    protected $table = 'rfid';

    protected $fillable = ['data'];
}
