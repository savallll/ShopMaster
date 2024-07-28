<?php

namespace App\Helpers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryHelper
{
    public static function uploadImage($image)
    {
        $upload = Cloudinary::upload($image->getRealPath());
        $imageUrl = $upload->getSecurePath();

        return $imageUrl;
    }
    
    public static function deleteImage($imageUrl)
    {
        try {
            $publicId = basename($imageUrl, "." . pathinfo($imageUrl, PATHINFO_EXTENSION));
            Cloudinary::destroy($publicId);
        } catch (Exception $ex) {
            Log::error("Error deleting image: " . $ex->getMessage());
        }
    }
}
