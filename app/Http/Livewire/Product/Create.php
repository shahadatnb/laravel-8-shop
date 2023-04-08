<?php

namespace App\Http\Livewire\Product;

use App\Models\Attribute;
use App\Models\AttributeOption;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Session;
use Auth;

class Create extends Component
{
    use WithFileUploads;
    public $mode, $store, $categories, $clubs, $sizes, $colors;

    public $sku, $barcode, $type, $parent_id, $status=0,$attributes, $title, $slug, $short_description, $description, $new, $featured,
    $thumbnail, $qty, $club_id, $store_id, $price, $cost, $special_price, $special_price_from, $special_price_to, $weight,
    $color, $color_label, $size, $size_label, $trackQuantity, $stockOutSell, $readyToShipping, $noShappingCharge,
    $selectcategories=[],$selectAttributes = [], $photos = [];

    //public $vnames = [], $vprices= [], $vspecial_prices = [], $vqtys = [], $vskus=[], $vbarcodes = [], $vsizes=[], $vcolors =[]; //$variant = [],
    public $productvariant = [];

    protected $listeners = ['selectVariants' => 'selectVariants'];

    protected $rules = [
        'title'=>'required|max:255|unique:products,title',
        'sku'=>'required|alpha_dash|max:255|unique:products,sku',
        'qty'=>'required|numeric',
        //'store_id'=>'required|numeric',
        'photos.*' => ['required','file','mimes:jpg,jpeg,png,gif','max:2048'],
        'productvariant.*.price'=>'required|numeric',
        'productvariant.*.qty'=>'required|numeric',
        'productvariant.*.special_price'=>'nullable|numeric',
        'productvariant.*.sku'=>'nullable|alpha_dash|unique:products,sku',
        'productvariant.*.barcode'=>'nullable|string',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectVariants()
    {
        $key = 1;
        if(!empty($this->size)){
            foreach($this->size as $size){
                if(!empty($this->color)){
                    foreach($this->color as $color){
                        $this->productvariant[$key] = [
                            'price' => $this->price,
                            'special_price' => $this->special_price,
                            'qty' => $this->qty,
                            'sku' => $this->sku ? $this->sku.'-'.$key : $key,
                            'barcode' => $this->barcode,
                            'size' => strtoupper($size),
                            'color' => ucfirst($color),
                        ];
                        ++$key;
                    }
                }else{
                    $this->productvariant[$key] = [
                        'price' => $this->price,
                        'special_price' => $this->special_price,
                        'qty' => $this->qty,
                        'sku' => $this->sku ? $this->sku.'-'.$key : $key,
                        'barcode' => $this->barcode,
                        'size' => strtoupper($size),
                        'color' => null,
                    ];
                    ++$key;
                }

            }
        }elseif(!empty($this->color)){
            foreach($this->color as $color){
                $this->productvariant[$key] = [
                    'price' => $this->price,
                    'special_price' => $this->special_price,
                    'qty' => $this->qty,
                    'sku' => $this->sku ? $this->sku.'-'.$key : $key,
                    'barcode' => $this->barcode,
                    'size' => null,
                    'color' => ucfirst($color),
                ];
                ++$key;
            }
        }

    }

    public function vremove($index)
    {
        unset($this->productvariant[$index]);
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photos.*' => 'image|max:10240', // 1MB Max
        ]);
    }

    public function tempPhotoRemove($index)
    {
        array_splice($this->photos, $index, 1);
    }

    private function productSlug($slug){
        $slug = Str::slug($slug, '-');
        $count = Product::where('slug','like',$slug.'%')->count();
        $suffix = $count ? $count+1 : '';
        $slug .= $suffix;
        return $slug;
    }

    public function save()
    {
        $this->validate();
        $slug = $this->productSlug($this->title);

        $pType = $this->type == 'variant' ? 'variant' : 'simple';

        $product = new Product;
        $product->title = $this->title;
        $product->slug = $slug;
        $product->type = $pType;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->special_price = $this->special_price;
        $product->sku = $this->sku;
        $product->barcode = $this->barcode;
        $product->qty = $this->qty;
        $product->stockOutSell = $this->stockOutSell;
        $product->trackQuantity = $this->trackQuantity;
        $product->readyToShipping = $this->readyToShipping;
        $product->noShappingCharge = $this->noShappingCharge;
        $product->status = $this->status;

        if(count($this->color)>0){
            $product->color = json_encode($this->color);
        }

        if(count($this->size)>0){
            $product->size = json_encode($this->size);
        }

        $product->user_id = Auth::user()->id;
        $product->save();

        if(count($this->productvariant) > 0){
            //return $request->cproduct;
            foreach ($this->productvariant as $key => $item) {
                $item['parent_id']=$product->id;
                $item['type']='simple';
                $item['status']=$product->status;
                $item['user_id']=Auth::user()->id;
                $item['title']='';
                if ($item['color'] != null){
                    $item['color_label']= AttributeOption::where('name',$item['color'])->first()->label;
                }

                $sku = Product::where('sku',$item['sku'])->first();
                if($sku){
                    unset($item['sku']);
                }

                Product::create($item);
            }
        }

        foreach ($this->photos as $photo) {
            $filename = md5(microtime()).'.'.$photo->extension();
            $path = 'product/'.date("Y").'/'.date("m");
            $full_path = $path.'/'.$filename;
            $photo->storeAs('public/'.$path,$filename);
            ProductImage::create(['path' => $full_path,'product_id'=>$product->id]);

            if($product->thumbnail == ''){
                $product->thumbnail = $full_path;
                $product->save();
            }
        }

        $product->categories()->sync($this->selectcategories);
        //$product->attributes()->sync($this->attribute);
        $product->attributes()->sync($this->selectAttributes);

        session()->flash('success', 'Product cereted successfully.');
        return redirect()->route('product.edit',$product->id);
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
