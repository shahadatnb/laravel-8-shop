<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Category::with('child')->where('status',1)->whereNull('parent_id')->paginate(20);
        //return $datas;
        $cats = $this->catArray();
        return view('admin.category.category',compact('datas','cats'));
    }

    private function catArray(){
        $datas = Category::where('status',1)->whereNull('parent_id')->get();
        $cats =array();
        foreach ($datas as $key => $value) {
            $cats[$value->id] = $value->title;
        }
        return $cats;
    }

    private function catSlug($slug, $id=''){
        $slug = Str::slug($slug, '-'); 
        if($id == ''){
           $count = Category::where('slug','like',$slug.'%')->count(); 
        }else{
            $count = Category::where('id','!=',$id)->where('slug','like',$slug.'%')->count();  
        }
        
        $suffix = $count ? $count+1 : '';
        $slug .= $suffix;
        return $slug;
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, array(
            'title'=>'required|max:255|unique:categories,title',
            'parent_id'=>'nullable',
            'image'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

        $slug = $this->catSlug($request->title);  

        $data = new Category;
        $data->title = $request->title;
        $data->slug = $slug;
        $data->parent_id = $request->parent_id;
        $data->status = 1;

        $image = $request->file('image');
        if ($image) {
            $upload = 'public/upload/category';
            $filename =  time() . '.' . $image->extension();
            $success = $image->move($upload, $filename);
            if ($success) {                
                $data->image = $filename;
            } else {
                return redirect()->back()->with('success', "File couldn't be uploaded.");
            }
        }

        $data->save();
        Session::flash('success','Successfully Save');
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        
    }


    public function edit(Category $category)
    {
        $cats = $this->catArray();
        return view('admin.category.edit',compact('category','cats'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, array(
            'title'=>[
                'required',
                Rule::unique('categories')->ignore($category->id),
            ],
            'parent_id'=>'nullable',
            'image'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

        $slug = $this->catSlug($request->title,$category->id);  

        $category->title = $request->title;
        $category->slug = $slug;
        $category->parent_id = $request->parent_id;
        $category->status = 1;

        $image = $request->file('image');
        if ($image) {
            $upload = 'public/upload/category';
            $filename =  time() . '.' . $image->extension();
            $success = $image->move($upload, $filename);
            if ($success) {                
                $category->image = $filename;
            } else {
                return redirect()->back()->with('success', "File couldn't be uploaded.");
            }
        }

        $category->save();
        session()->flash('success','Successfully Save');
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        if($category->child->count()==0){
            $category->delete();
            session()->flash('success','Successfully Deleted');
        }else{
            session()->flash('warning','There are more sub-categories under this category');
        }
        
        return redirect()->back();
    }
}
