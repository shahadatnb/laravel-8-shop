<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Cart;

class SingleProduct extends Component
{
    public $product, $productvariant=[];
    public $sizes = [], $colors=[], $attribute_size, $attribute_color_label, $attribute_color, $price, $special_price, $sku, $stock = 'None',
    $productquantity = 1, $product_id, $product_type;

    protected $listeners = ['productFilter' => 'productFilter'];

    public function quantityminus()
    {
        if($this->productquantity > 1){
            $this->productquantity--;
        }
    }

    public function quantityplus()
    {
        $this->productquantity++;
    }

    public function addToWishlist($id){
        $this->emit('addToWishlist',['id'=>$id]);
    }

    public function productFilter(){ //->where('size',$this->attribute_size)->where('color',$this->attribute_color)
        $product = $this->product->childs;
        if($this->attribute_size != null ){
            $product = $product->where('size',$this->attribute_size);
        }
        if($this->attribute_color != null ){
            //$product = $product->where('color',$this->attribute_color);
            $product = $product->where('color_label',$this->attribute_color);
        }
        $product = $product->first();

        if($product){
            $this->product_type = $product->type;
            $this->product_id = $product->id;
            $this->price = $product->price;
            $this->special_price = $product->special_price;
            $this->sku = $product->sku;
            $this->attribute_color_label = $product->color;
            $this->stock = $product->qty > 0 ? 'In Stock' : 'Not available';
        }else{
            $this->stock = 'None';
        }


    }

    public function mount()
    {
        /*
        foreach($this->product->childs as $product){
            $this->productvariant[$product->id] = $product->toArray();
        }
        */
        $this->sizes = array_unique($this->product->childs->pluck('size')->toArray());
        //$this->colors = array_unique($this->product->childs->pluck('color')->toArray());
        $this->colors = array_unique($this->product->childs->pluck('color_label')->toArray());

        $this->product_type = $this->product->type;
        $this->product_id = $this->product->id;
        $this->price = $this->product->price;
        $this->special_price = $this->product->special_price;
        $this->sku = $this->product->sku;
        //dd($this->size);
    }

    public function addToCart(){
        $this->validate([
            'product_id' => ['required'],
            'productquantity' => ['required'],
        ]);
        //dd($this->product_id); exit;
        //Cart::addToCart(['id'=>$this->product_id,'qty'=>$this->productquantity]);
        $this->emit('addToCart',['id'=>$this->product_id,'qty'=>$this->productquantity]);
    }

    public function render()
    {
        return view('livewire.product.single-product');
    }
}
