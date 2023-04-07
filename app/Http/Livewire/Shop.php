<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class Shop extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $store, $product, $cats = array(), $categories='', $fcats = array();

    public function mount(){
        $this->categories = Category::with('child')->where('status',1)->whereNull('parent_id')->get();
        //$this->filtered_product =  Product::whereNull('parent_id')->where('store_id',$this->store->id)->where('status',1)->latest();
    }

    public function quickView($id){
        $this->product = Product::find($id);
        if($this->product ){
            $this->dispatchBrowserEvent('quick-view', ['id' => $id]); 
        }               
    }

    public function addToCart($id){
        $this->emit('addToCart',['id'=>$id,'qty'=>1]);
    }

    public function addToWishlist($id){
        $this->emit('addToWishlist',['id'=>$id]);
    }

    public function selectCat($id){
        if (!in_array($id, $this->cats)) {
            array_push($this->cats, $id);  
        }              
        $this->catFilter();
    }

    public function removeCat($id){
        if (($key = array_search($id, $this->cats)) !== false) {
            unset($this->cats[$key]);
        }
        $this->catFilter();
    }

    public function catFilter(){        
        $this->fcats = Category::whereIn('id',$this->cats)->get();
    }

    public function selectSize($id){
        if (!in_array($id, $this->cats)) {
            array_push($this->cats, $id);  
        }              
        $this->sizeFilter();
    }

    public function removeSize($id){
        if (($key = array_search($id, $this->cats)) !== false) {
            unset($this->cats[$key]);
        }
        $this->sizeFilter();
    }

    public function sizeFilter(){        
        $this->fcats = Category::whereIn('id',$this->cats)->get();
    }

    public function render()
    {        
        $products = Product::whereNull('parent_id')->where('status',1);
        if(!empty($this->cats)){
            $products = $products->whereHas('categories', function($q){
                $q->whereIn('id', $this->cats);
            });
        }
        $products = $products->latest()->paginate(20);
        return view('livewire.shop',[
            'products' => $products
        ]);
    }
}
