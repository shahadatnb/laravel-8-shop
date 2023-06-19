<?php

namespace App\Http\Livewire\Product;
use App\Models\AttributeOption;
use Illuminate\Validation\Rule;

use Livewire\Component;
use App\Models\Product;

class Variant extends Component
{
    public $product, $productvariant=[], $newVariant=[], $colors, $sizes;

    public function mount()
    {
        foreach($this->product->childs as $product){
            //dd($product->toArray());
            $this->productvariant[$product->id] = $product->toArray();
            unset($this->productvariant[$product->id]['created_at']);
            unset($this->productvariant[$product->id]['updated_at']);
        }
        if($this->productvariant == []){
            $this->newVariant['type'] = 'simple';
            $this->newVariant['parent_id'] = $this->product->id;
            $this->newVariant['user_id'] = $this->product->user_id;
            $this->newVariant['special_price'] = '';
        }else{
            $this->newVariant = current($this->productvariant);
            unset($this->newVariant['id']);
        }
        
        $this->newVariant['color'] = '';
        $this->newVariant['color_label'] = '';
        $this->newVariant['size']= '';
    }

    protected $rules = [
        'productvariant.*.size'=>'nullable|string',
        'productvariant.*.color'=>'nullable|string',
        'productvariant.*.price'=>'required|numeric',
        'productvariant.*.qty'=>'required|numeric',
        'productvariant.*.sku'=>'nullable|alpha_dash',
        'productvariant.*.barcode'=>'nullable|string',
        // 'productvariant.*.sku'=>[
        //     'nullable','max:255',
        //     Rule::unique('products')->ignore($this->product->id),
        // ],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function delete($id){
        $product = Product::find($id);
        if($product){
            if($product->cartItem->count() > 0){
                session()->flash('warning', 'Product already cart added.');
            }else{
                $product->delete();
                unset($this->productvariant[$id]);
                session()->flash('success', 'Product variant deleted.');
            }

        }
    }

    public  function addVariant(){
        //dd($this->newVariant);
        $this->validate([
            'newVariant.size'=>'required|string',
            'newVariant.color'=>'nullable|string',
            'newVariant.price'=>'required|numeric',
            'newVariant.special_price'=>'nullable|numeric',
            'newVariant.qty'=>'nullable|numeric',
            'newVariant.sku'=>'nullable|alpha_dash|unique:products,sku',
            'newVariant.barcode'=>'nullable|string',
        ]);
        if ($this->newVariant['color'] != null){
            $color = AttributeOption::where('name',$this->newVariant['color'])->first();
            $this->newVariant['color_label']= $color->label;
        }
        $product = Product::create($this->newVariant);
        session()->flash('success', 'New product variant added.');
        $this->emit('newVariantSaved');

        $this->productvariant[$product->id] = $product->toArray();
        unset($this->productvariant[$product->id]['created_at']);
        unset($this->productvariant[$product->id]['updated_at']);
    }

    public function save()
    {
        $validatedData = $this->validate();

        foreach($this->productvariant as $item){
            //dd($item);
            if ($item['color'] != null){
                $color = AttributeOption::where('name',$item['color'])->first();
                //$item['color']= $color->name;
                $item['color_label']= $color->label;
            }
            $sku = Product::where('sku',$item['sku'])->where('id','!=',$item['id'])->first();
            if($sku){
                unset($item['sku']);
                session()->flash('warning', 'Variant ID'.$item['id'].' SKU duplicate.');
            }

            Product::where('id', $item['id'])->update($item);
        }
        session()->flash('success', 'Product variant updated.');
        //$this->mount();
    }


    public function render()
    {
        return view('livewire.product.variant');
    }
}
