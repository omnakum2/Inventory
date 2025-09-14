<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;

    protected $table = "stock";

    protected $fillable = [
        "quantity",
        "wharehouse_id",
        "prouct_code",
    ] ;

    protected function wharehouse(){
        return $this->belongsTo(Wharehouse::class, 'wharehouse_id', 'id');
    }

    protected function product(){
        return $this->belongsTo(Product::class, 'product_code', 'code');
    }
}
