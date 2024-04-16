<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';
    protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = ['id', 'sale', 'min_sale'];
}
