<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected  $fillable  = [
        'category_id', 'name', 'slug', 'status', 'created_by', 'updated_by',
    ];

    public const ACTIVE_STATUS = 'active';
    public const INACTIVE_STATUS = 'inactive';

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
