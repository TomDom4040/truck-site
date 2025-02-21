<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'category_id',
        'city_id',
        'description',
        'user_id',
        'price',
        'package',
        'tg',
        'fb',
        'status',
        'share_link', // Добавляем поле для хранения ссылки
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

    // Генерация и сохранение ссылки на объявление
    public static function boot()
    {
        parent::boot();

        static::created(function ($ad) {
            // Генерация ссылки для объявления на основе ID
            $ad->share_link = '/ads-' . $ad->id;
            $ad->save(); // Сохраняем обновленную ссылку
        });
    }
}
