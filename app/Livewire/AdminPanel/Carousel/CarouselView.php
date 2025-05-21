<?php

namespace App\Livewire\AdminPanel\Carousel;

use App\Actions\Carousel\GetCarousel;
use App\Actions\DeleteMedia;
use App\Actions\StoreMedia;
use App\Models\Carousel;
use App\Models\CarouselImage;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarouselView extends Component
{
    use WithFileUploads;
    public $record;
    public $logo_url;
    public $imgs = [];

    // Add this method to debug file uploads
    #[On('save')]
    public function save()
    {
        // Debug before processing
        $manager = new ImageManager(new Driver());
        // add new image and delete old
        if (!empty($this->logo_url)) {
            $path = StoreMedia::execute(
                $this->logo_url,
                'carousel/' . $this->record->id . '/logo',
                'public'
            );
            if ($this->record->logo_url) {
                Storage::disk('public')->delete($this->record->logo_url);
            }
            $this->record->logo_url =  $path;
            $this->record->save();
        }
        //
        if ($this->imgs) {
            $this->record = GetCarousel::execute($this->record->id);
            foreach ($this->record->images as $image) {
                DeleteMedia::execute($image->url);
            }
            $this->record->images()->delete();
            $this->record->save();
            // add other product images
            // foreach ($this->imgs as $imageFile) {
            //     $image = new CarouselImage();
            //     $path = StoreMedia::execute(
            //         $imageFile,
            //         'carousel/' . $this->record->id . '',
            //         'public'
            //     );
            //     $image->url = $path;
            //     $image->carousel_id = $this->record->id;
            //     $image->save();
            // }
            foreach ($this->imgs as $imagefile) {
                $image = new CarouselImage();

                // Process the image
                $myImage = $manager->read($imagefile->getPathname());
                $compressedImage = $myImage->scaleDown(1920, 1080);

                // Define the storage path
                $storagePath = 'carousel/' . $this->record->id;

                // Generate a unique filename
                $filename = uniqid() . '.png';

                // Store the image in public/storage
                $compressedImage->save(storage_path('app/public/' . $storagePath . '/' . $filename));

                // The public URL would be accessible at /storage/carousel/{id}/{filename}
                $publicUrl = '/' . $storagePath . '/' . $filename;
                info($publicUrl);
                $image->url = $publicUrl;
                $image->carousel_id = $this->record->id;
                $image->save();
            }
        }

        $this->dispatch('record-created', [
            'title' => 'Success!',
            'text' => 'Files uploaded successfully.',
            'type' => 'success',
        ]);
    }
    public function render()
    {
        return view('livewire.admin-panel.carousel.carousel-view');
    }
}
