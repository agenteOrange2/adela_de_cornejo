<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'paragraph', 'link'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImageUrlAttribute()
    {
        $image = $this->images->first();
        if ($image && $image->path) {
            return asset('storage/' . $image->path);
        }
        return 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
    }

    public function getDesktopImage()
    {
        return $this->images()->where('path', 'like', '%-1920x1080.%')->first();
    }

    public function getTabletImage()
    {
        return $this->images()->where('path', 'like', '%-1024x768.%')->first();
    }

    public function getMobileImage()
    {
        return $this->images()->where('path', 'like', '%-375x667.%')->first();
    }

    public function getImageUrl($size)
    {
        return $this->getImageUrlBySize($size);
    }

    private function getImageUrlBySize($size)
    {
        $image = $this->images()->where('path', 'like', '%-' . $size . '.%')->first();
        if ($image) {
            return asset('storage/' . $image->path);
        }

        // If specific size image does not exist, return optimized main image
        $mainImage = $this->images->firstWhere('path', 'like', '%-1920x1080.%');
        if ($mainImage) {
            return $this->getOptimizedImageUrl($mainImage->path, $size);
        }

        // Return default placeholder image if no image found
        return 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
    }

    private function getOptimizedImageUrl($path, $size)
    {
        $manager = new ImageManager(new Driver());

        $optimizedPath = str_replace('1920x1080', $size, $path);

        // Check if optimized image already exists
        if (Storage::exists('public/' . $optimizedPath)) {
            return asset('storage/' . $optimizedPath);
        }

        // Optimize and store the image
        $imagePath = storage_path('app/public/' . $path);
        $optimizedImagePath = storage_path('app/public/' . $optimizedPath);

        $img = $manager->read($imagePath);
        [$width, $height] = explode('x', $size);
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($optimizedImagePath, 75);

        return asset('storage/' . $optimizedPath);
    }
}

