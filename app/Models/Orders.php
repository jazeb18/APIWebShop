<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = '_orders';
    protected $fillable = [
        'customer',
        'payed',
        'product',
    ];
}
