<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected  $fillable  = [
        'name', 'email', 'phone', 'address', 'status', 'created_by', 'updated_by',
    ];
    public const ACTIVE_STATUS = 'active';
    public const INACTIVE_STATUS = 'inactive';

    public function products() {
        return $this->hasMany(Product::class);
    }


}
