<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected  $fillable  = [
        'name', 'email', 'phone', 'address', 'status', 'created_by', 'updated_by',
    ];
}
