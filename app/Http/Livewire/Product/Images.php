<?php

namespace App\Http\Livewire\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;
use App\Models\ProductImage;
use App\Models\Product;
use Image;

class Images extends Component
{
    use WithFileUploads;
    public $photos, $product, $thumbnail = 0;

    private function resetInput()
    {
        $this->photos = '';
    }

    public function phoroRemove($id){        
        $image = ProductImage::find($id);
        Storage::delete('public/'.$image->path);
        $image->delete();
        $this->mount();
    }

    public function makeThumb($id){        
        $image = ProductImage::find($id);
        //dd(Storage::get('public/'.$image->path));
        //Storage::delete($image->path);
        $imgFile  = Image::make(Storage::get('public/'.$image->path))->resize(330, 330, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg',80);
        $file_name = 'product/thumb/'.time() .'.jpg';
        Storage::disk('public')->put($file_name, $imgFile);
        //dd($this->product);
        $this->product->thumbnail = $file_name;
        $this->product->save();
        $this->emit('thumbUpdated', asset('storage/'.$file_name));
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
            /*
            $imgFile  = Image::make($photo->getRealPath())->resize(320, 240, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($photo->extension(),80);//->save('public/bar.jpg');

            Storage::disk('public')->put($path.'/thumb-'.$filename, $imgFile);
            */
            $full_path = Storage::disk('public')->putFileAs(
                $path, $photo, $filename
            );

            //$photo->storeAs('public/'.$path, $filename);
            //$this->photo->store('photo');

            ProductImage::create(['path' => $full_path,'product_id'=>$this->product->id]);
        }

        $this->resetInput();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.product.images');
    }
}
