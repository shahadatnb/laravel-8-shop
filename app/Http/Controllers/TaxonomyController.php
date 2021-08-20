<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Http\Traits\PostTrait;
use App\Models\Taxonomy;
use App\Models\Post;
use Session;

class TaxonomyController extends Controller
{
    use PostTrait;

    public function index(Request $request)
    {
        $posttype=$this->postTypeCheck($request);
        $mode='create';
        $AllTaxonomy=Taxonomy::where('post_type',$posttype['postType'])->orderBy('id','desc')->paginate(20);
        return view('admin.posts.taxonomy', compact('AllTaxonomy','posttype','mode'));
    }

    protected function taxSlug($slug){
        $slug_check = Taxonomy::where('slug',$slug)->count();
        if($slug_check > 0){
            ++$slug_check;
            $slug = $slug.'-'.$slug_check;
        }
        $slug_check = Taxonomy::where('slug',$slug)->count();
        if($slug_check > 0){
            $this->postSlug($slug);
        }
        return $slug;
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title'=>'required|max:255|unique:taxonomies,title',
            'post_type'=>'required',
            'image'=>'nullable|mimes:jpg,jpeg,png|max:5000'
            ));

        $slug = Str::slug($request->title, '-');
        $slug = $this->taxSlug($slug);

        $data = new Taxonomy;
        $data->title = $request->title;
        $data->slug = $slug;
        $data->post_type = $request->post_type;
        $data->parent_id = $request->parent_id;
        $data->save();
        $image = $request->file('image');
        if ($image) {
            $filename = $data->id.'.'.$image->extension();
            $full_path = 'post_file/'.$filename;
            $image->storeAs('public/post_tax_file/', $filename);
            $data->image = $full_path;
            $data->save();
        }

        Session::flash('success','Successfully Save');
        return redirect()->back();
    }


    public function edit(Request $request, $id)
    {
        $mode='edit';
        $taxonomy=Taxonomy::find($id);
        $posttype=$this->postTypeCheck($request);
        return view('admin.posts.taxonomy', compact('taxonomy','posttype','mode'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title'=>[
                'required','min:5','max:191',
                Rule::unique('taxonomies')->ignore($id),
            ],
            'post_type'=>'required',
            'image'=>'nullable|mimes:jpg,jpeg,png|max:5000'
            ));

        //$slug = Str::slug($request->title, '-');
        //$slug = $this->taxSlug($slug);

        $data = Taxonomy::find($id);
        $data->title = $request->title;
        //$data->slug = $slug;
        $data->post_type = $request->post_type;
        $data->parent_id = $request->parent_id;
        $data->save();

        $image = $request->file('image');
        if ($image) {
            $filename = $data->id.'.'.$image->extension();
            $full_path = 'post_file/'.$filename;
            $image->storeAs('public/post_tax_file/', $filename);
            $data->image = $full_path;
            $data->save();
        }

        Session::flash('success','Successfully Save');
        $url = route('taxonomy.index');
        $url=$url.'?type='.$data->post_type;
        return redirect($url);
    }


    public function destroy($id)
    {
        $item=Taxonomy::find($id);
        if($item){
                $item->delete();
                Session::flash('success','Removed');
        }
        else{
            Session::flash('warning','Not Found');
            }

        $url = route('taxonomy.index');
        $url=$url.'?type='.$item->post_type;
        return redirect($url);
    }
}
