<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

        $photoPath = is_array($this->photo) ? ($this->photo[0] ?? '') : $this->photo;
        return env('APP_URL') . '/storage/services-photos/' . $photoPath;
    }
}
