<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['brand_id', 'category_id','product_id', 'invoice_no', 'unit_id', 'date', 'description', 'status',
        'updated_by', 'created_by'];


    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id','invoice_id');
    }
    public function invoice_details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id','id');
    }


}
