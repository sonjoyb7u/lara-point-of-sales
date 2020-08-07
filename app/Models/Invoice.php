<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected  $fillable  = [
        'invoice_no', 'date', 'desc', 'status', 'created_by', 'updated_by',
    ];

    public const PENDING_STATUS = 'pending';
    public const APPROVED_STATUS = 'approved';


    public function invoice_details() {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

}
