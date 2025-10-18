<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'photo_path',
        'caption',
    ];

    /**
     * Get the URL of the gallery photo
     */
    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return null;
        }

        // Try S3 first, fallback to local if S3 fails
        try {
            return Storage::disk('s3')->url($this->photo);
        } catch (\Exception $e) {
            // Fallback to local storage
            return asset('storage/' . $this->photo);
        }
    }
}
