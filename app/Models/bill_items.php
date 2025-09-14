<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_items extends Model
{
    use HasFactory;

    protected $table = "bill_items";

    protected $fillable = [
        "product_code",
        "product_price",
        "product_quantity",
        "total",
        "bill_id",
    ];
}
