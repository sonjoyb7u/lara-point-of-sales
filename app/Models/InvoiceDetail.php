<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected  $fillable  = [
        'invoice_id', 'category_id', 'sub_category_id', 'product_id', 'date', 'selling_qty', 'unit_price', 'selling_price', 'status',
    ];

    public const ACTIVE_STATUS = 'active';
    public const INACTIVE_STATUS = 'inactive';

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
