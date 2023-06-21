<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\AttributeOption;

class Shop extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $store,$rangeMin=0, $rangeMax=10000, $product, $cats=[], $categories='', $sizes='', $colors='', $size=[], $color=[], $priceMin=0, $priceMax=10000, $quickItem ='';

    public function mount(){
        $this->categories = Category::with('child')->withCount('products')->where('status',1)->whereNull('parent_id')->get();
        $this->sizes = AttributeOption::whereHas('attribute',function($q){
            $q->where('code','size');
        })->get();
        $this->colors = AttributeOption::whereHas('attribute',function($q){
            $q->where('code','color');
        })->get();
        $max = Product::where('status',1)->max('price');
        $this->rangeMax = $this->priceMax = ceil($max / 100) * 100;
        //dd($this->rangeMax);
    }

    public function quickView($id){
        $this->quickItem = Product::find($id);
        //dd($this->quickItem);
        if($this->quickItem ){
            $this->dispatchBrowserEvent('quick-view', ['id' => $id]); 
        }
    }

    public function addToCart($id){
        $this->emit('addToCart',['id'=>$id,'qty'=>1]);
    }

    // public function quickView($id){
    //     $this->emit('quickView',['id'=>$id]);
    // }

    public function addToWishlist($id){
        $this->emit('addToWishlist',['id'=>$id]);
    }

    public function render()
    {        
        $products = Product::whereNull('parent_id')->whereBetween('price', [$this->priceMin, $this->priceMax])->where('status',1);
        if(!empty(array_filter($this->cats))){
            $products = $products->whereHas('categories', function($q){
                $q->whereIn('id', array_filter($this->cats));
            });
        }
        if(!empty($this->size)){
            $products = $products->whereHas('childs', function($q){
                $q->whereIn('size', array_filter($this->size));
            });
        }
        if(!empty(array_filter($this->color))){
            $products = $products->whereHas('childs', function($q){
                $q->whereIn('color', array_filter($this->color));
            });
        }
        $products = $products->latest()->paginate(40);
        return view('livewire.shop',[
            'products' => $products
        ]);
    }
}
