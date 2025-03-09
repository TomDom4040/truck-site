<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'city_id',
        'description',
        'status',
        'price',
        'tg',
        'fb',
        'package_id', // Измените на package_id
        'share_link',
        'approved_at',
    ];
// Приведение approved_at к типу datetime
protected $dates = [
    'approved_at',
    'created_at',
    'updated_at',
];

// Или используйте $casts, если хотите явно указать тип
protected $casts = [
    'approved_at' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
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

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function package()
{
    return $this->belongsTo(Package::class, 'package', 'id');
}


    public static function boot()
    {
        parent::boot();

        static::created(function ($ad) {
            $ad->share_link = '/ads-' . $ad->id;
            $ad->save();
        });
    }
}