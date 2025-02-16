<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'ad_id',
        'path',
        'type', // Тип медиа (image, video)
    ];

    // Связь с объявлением
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
