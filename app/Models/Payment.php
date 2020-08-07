<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected  $fillable  = [
        'invoice_id', 'customer_id', 'paid_status', 'paid_amount', 'due_amount', 'total_amount', 'discount_amount',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}
