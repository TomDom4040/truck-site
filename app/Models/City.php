<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
   
    use HasFactory;
    // Указываем, какие поля можно массово присваивать
    protected $fillable = ['name', 'price'];
}
