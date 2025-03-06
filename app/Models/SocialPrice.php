<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPrice extends Model
{
    use HasFactory;

    protected $fillable = ['tg_price', 'fb_price'];
}
