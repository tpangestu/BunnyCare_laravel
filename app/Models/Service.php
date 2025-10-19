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
        'photo' => 'json'
    ];

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return null;
        }

        // If photo is already a full URL (from Cloudinary), return it
        if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
            return $this->photo;
        }

        // Extract the public ID by removing the file extension
        $publicId = pathinfo($this->photo, PATHINFO_FILENAME);

        // Generate Cloudinary URL using the public ID
        return \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::getUrl($publicId);
    }
}
