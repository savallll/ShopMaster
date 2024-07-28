<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Helpers\CloudinaryHelper;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }
    
    public function upload($file)
    {
        // Thực hiện tải ảnh lên Cloudinary
        $imageUrl = CloudinaryHelper::uploadImage($file);
        
        // Return đường dẫn ảnh đã tải lên
        return $imageUrl;
    }

    public function delete($imageUrl)
    {
        // Thực hiện xóa ảnh từ Cloudinary
        CloudinaryHelper::deleteImage($imageUrl);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
