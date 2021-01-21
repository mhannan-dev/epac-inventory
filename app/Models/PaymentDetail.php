<?php

namespace App\Models;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable = ['current_paid_amount', 'invoice_no','date', 'updated_by'];



}
