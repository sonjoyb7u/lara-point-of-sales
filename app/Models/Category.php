<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected  $fillable  = [
        'name', 'slug', 'status', 'created_by', 'updated_by',
    ];

    public const ACTIVE_STATUS = 'active';
    public const INACTIVE_STATUS = 'inactive';

    public function sub_categories() {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }


}
