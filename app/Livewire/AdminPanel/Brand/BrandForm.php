<?php

namespace App\Livewire\AdminPanel\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandForm extends Component
{
    use WithFileUploads;
    public $record;
    public $path;
    public $form = [];

    public $image_url;

    public function mount()
    {
        if (!empty($this->record)) {
            $this->form = [
                'name_en' => $this->record->name_en,
                'name_ar' => $this->record->name_ar,
            ];
            $this->path = $this->record->image_url;
        }
    }
    public function save()
    {
        $this->validate([
            'form.name_en' => 'required',
            'form.name_ar' => 'required',
            'image_url' => 'nullable|image',
        ]);
        // add new image and delete old
        if (!empty($this->image_url)) {
            $this->path = $this->image_url->storePublicly('brands', 'public');
            if ($this->record) {
                if ($this->record->image_url) {
                    Storage::disk('public')->delete($this->record->image_url);
                }
            }
        }
        $newRecord = Brand::updateOrCreate(
            ['id' => $this->record?->id ?? 0],
            [
                'name_en' => $this->form['name_en'],
                'name_ar' => $this->form['name_ar'],
                'image_url' => $this->path
            ]
        );

        if ($newRecord) {
            $this->dispatch('record-created', [
                'title' => 'Success!',
                'text' => 'Files uploaded successfully.',
                'type' => 'success',
            ]);
        }
        if (empty($this->record))
            $this->form = [];
    }
    public function render()
    {
        return view('livewire.admin-panel.brand.brand-form');
    }
}
