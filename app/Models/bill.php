<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;

    protected $table = "bill";

    protected $fillable = [
        "user_id",
        "customer_name",
        "customer_phone",
        "amount",
    ];
}
