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

        // If photo is already a full URL (from Cloudinary), return it
        if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
            return $this->photo;
        }

        // The photo field contains the full Cloudinary public ID including directory
        // Remove the file extension to get the clean public ID
        $publicId = preg_replace('/\.[^.]+$/', '', $this->photo);

        // Generate Cloudinary URL using the public ID
        return \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::getUrl($publicId);
    }
}
