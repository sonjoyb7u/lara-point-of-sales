<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected  $fillable  = [
        'supplier_id', 'unit_id', 'category_id', 'sub_category_id', 'product_id', 'purchase_no', 'purchase_date', 'desc', 'unit_price', 'buying_qty', 'buying_price', 'status', 'created_by', 'updated_by',
    ];

    public const PENDING_STATUS = 'pending';
    public const APPROVED_STATUS = 'approved';
    public const RETURN_STATUS = 'return';

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function sub_category() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
