<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wharehouse extends Model
{
    use HasFactory;

    protected $table = "wharehouse";

    protected $fillable = [
        "name",
        "status",
    ] ;
}
