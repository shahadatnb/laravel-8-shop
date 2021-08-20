<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

class Product extends Component
{
    public $image;

    protected $listeners = [
        'fileUpload'     => 'handleFileUpload',
    ];

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }


    public function render()
    {
        return view('livewire.product.product');
    }
}
