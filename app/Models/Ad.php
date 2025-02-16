<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'category_id',
        'city_id',
        'description',
        'user_id', // Это кто публиковал объявление
        'created_at', // Время публикации
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Связь с медиафайлами
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
