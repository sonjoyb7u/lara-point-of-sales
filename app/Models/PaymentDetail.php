<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected  $fillable  = [
        'invoice_id', 'date', 'current_paid_ammount', 'updated_by',
    ];
}
