<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = "product";

    protected $fillable = [
        "code",
        "name",
        "description",
        "category_id",
        "brand_id",
        "price",
        "status",
    ];

    protected function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

    protected function brand()
    {
        return $this->belongsTo(brand::class, 'brand_id', 'id');
    }
}
