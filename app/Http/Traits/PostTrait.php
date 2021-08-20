<?php
namespace App\Http\Traits;
use Illuminate\Support\Arr;
use App\Models\Taxonomy;

trait PostTrait {

	protected $postType = array(
        'post' => array(
            'title'     => 'Post',
            'postType'  => 'post',
            'icon'  => 'fa-thumbtack',
            'taxonomy'  => true,
            'supports'   => array('title','body','image','slug'),
        ),
        'page' => array(
            'title'     => 'Page',
            'postType'  => 'page',
            'icon'      => 'fa-file',
            'taxonomy'  => false,
            'supports'   => array('title','body','image','slug'),
        ),
        'slide' => array(
            'title'     => 'Slide',
            'postType'  => 'slide',
            'icon'      => 'fa-image',
            'taxonomy'  => false,
            'supports'   => array('title','body','image','sort'),
        ),
        'client-logo' => array(
            'title'     => 'Client Logo',
            'postType'  => 'client-logo',
            'icon'      => 'fa-image',
            'taxonomy'  => false,
            'supports'   => array('title','image'),
        ),
        'produce' => array(
            'title'     => 'Produce',
            'postType'  => 'produce',
            'icon'      => 'fa-image',
            'taxonomy'  => false,
            'supports'   => array('title','image'),
        ),

        'why-us' => array(
            'title'     => 'Why us',
            'postType'  => 'why-us',
            'icon'      => 'fa-image',
            'taxonomy'  => true,
            'supports'   => array('title','body','image','sort'),
        ),

        'testimonial' => array(
            'title'     => 'Testimonial',
            'postType'  => 'testimonial',
            'icon'      => 'fa-thumbtack',
            'taxonomy'  => false,
            'supports'   => array('title','body','image'),//,'postMeta'
            'postMeta'  => array(
                array('name'=>'designation','title'=>'Designation','fildType'=>'text','required'=>true),
            )
        ),
    );

    public function postTypeCheck($request){
        if(!empty($request->type)){
            if(Arr::has($this->postType, $request->type)){
                return Arr::get($this->postType, $request->type);
            }else{
                return Arr::get($this->postType, 'post');
            }
        }else {
            return Arr::get($this->postType, 'post');
        }
    }

    public function postTypeIs($postType){
        if(Arr::has($this->postType, $postType)){
            return true;
        }else{
            return false;
        }
    }
/*
    public function postTypeCheck(){
        if(!empty(Input::get('type'))){
            if(array_has($this->postType, Input::get('type'))){
                return array_get($this->postType, Input::get('type'));
            }else{
                return array_get($this->postType, 'post');
            }
        }else {
            return array_get($this->postType, 'post');
        }
    } */

    public function taxByType($postType){
        $tax = Taxonomy::where('post_type',$postType)->where('status',1)->orderBy('title','asc')->get();
        return $tax;
    }


    public function taxArray($postType){
        $tax = $this->taxByType($postType);
        $taxs = array();
        foreach ($tax as $value) {
            $taxs[$value->id] = $value->title;
        }
        return $taxs;
    }

    public function taxIdBySlug($slug){
        $tax = Taxonomy::where('slug',$slug)->where('status',1)->first();
        //dd($tax);
        if($tax){
            return $tax;
        }else{
            //$tax = array();
            return null;
        }
    }

}
