<?php

namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['product_id', 'invoice_no', 'unit_id', 'date', 'description', 'status',
        'updated_by', 'created_by'];


    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'id','invoice_id');
    }
    
    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id','id');
    }


}
