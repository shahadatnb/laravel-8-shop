<?php

namespace App\Http\Livewire\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;
use App\Models\ProductImage;
use App\Models\Product;

class Images extends Component
{
    use WithFileUploads;
    public $photos, $product;

    private function resetInput()
    {
        $this->photos = '';
    }

    public function phoroRemove($id){        
        $image = ProductImage::find($id);
        Storage::delete($image->path);
        $image->delete();
        $this->mount();
    }

    public function mount()
    {
        $this->product = Product::find($this->product->id);        
    }

    public function tempPhotoRemove($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function save()
    {
        $this->validate([
            'photos.*' => ['required','file','mimes:jpg,jpeg,png,gif','max:2048'],
        ]);
        foreach ($this->photos as $photo) {
            $filename = md5($photo . microtime()).'.'.$photo->extension();
            $path = 'product/'.date("Y").'/'.date("m");
            $full_path = $path.'/'.$filename;

            $photo->storeAs('public/'.$path, $filename);
            //$this->photo->store('photo');

            ProductImage::create(['path' => $full_path,'product_id'=>$this->product->id]);

            if($this->product->thumbnail == ''){
                $this->product->thumbnail = $full_path;
                $this->product->save();
            }
        }

        $this->resetInput();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.product.images');
    }
}
