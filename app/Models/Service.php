<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'price',
        'description',
        'type',
    ];

    protected $casts = [
        'photo' => 'array'
    ];

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return null;
        }

        $disk = config('filesystems.default');
        return url(Storage::disk($disk)->url($this->photo[0] ?? ''));
    }
}