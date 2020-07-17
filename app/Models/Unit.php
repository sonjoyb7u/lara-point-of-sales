<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected  $fillable  = [
        'name', 'status', 'created_by', 'updated_by',
    ];
}
