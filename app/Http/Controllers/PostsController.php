<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\PostTrait;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Taxonomy;
use App\Models\Postmeta;
use Session;
use Auth;

class PostsController extends Controller
{
    use PostTrait;

    public function index(Request $request)
    {
        $posttype=$this->postTypeCheck($request);
        $taxonomy = $this->taxArray($posttype['postType']);
        $taxId = null;
        if(!empty($request->taxonomy)){
            $taxId=$request->taxonomy;
            $taxonomes = Taxonomy::findOrFail($taxId);
            $posts=$taxonomes->posts;
            //dd($posts);
        }else {
            $posts=Post::where('post_type', $posttype['postType'])->orderBy('id', 'desc')->paginate(20);
        }


        //$posts=Posts::paginate(2);
        //return view('admin.posts.index')->withPosts($posts)->withPosttype($posttype);
        return view('admin.posts.index', compact('posts','posttype','taxonomy','taxId'));
    }

    public function postOrder(Request $request)
    {
        $posttype=$this->postTypeCheck($request);
        $taxonomy = $this->taxArray($posttype['postType']);
        $posts = null;
        $taxId = null;
        if(!empty($request->taxonomy)){
            $taxId=$request->taxonomy;
            $taxonomes = Taxonomy::with(['posts' => function ($q) {
                $q->orderBy('sort');
            }])->where('id',$taxId)->first();
            $posts=$taxonomes->posts;
            //dd($posts);
        }else {
            if($posttype['taxonomy']==false){
                $posts=Post::where('post_type', $posttype['postType'])->orderBy('sort')->get();
            }
        }

        return view('admin.posts.postOrder', compact('posts','posttype','taxonomy','taxId'));
    }


    public function create(Request $request)
    {
        $posttype=$this->postTypeCheck($request);
        $taxonomy = $this->taxByType($posttype['postType']);
        //dd(in_array('postMeta',$posttype['support']));
        $mode='create';
        return view('admin.posts.createOrEdit', compact('posttype','taxonomy','mode'));
    }


    private function postSlug($slug){
        $slug = Str::slug($slug, '-');
        $count = Post::where('slug','like',$slug.'%')->count();
        $suffix = $count ? $count+1 : '';
        $slug .= $suffix;
        return $slug;
    }

    protected function InsValidator($data, $othersFileUpload=true)
    {
        $data = [
            'title'=>'required|max:191',
            'body'=>'nullable',
        ];
        if($othersFileUpload==true){
            $data['image'] = ['nullable','mimes:jpg,jpeg,png,pdf,doc,docx,ppt,ppts,xls,xlsx','max:5000'];
        }else{
            $data['image'] = ['nullable','mimes:jpg,jpeg,png','max:5000'];
        }
        return $data;

 /*        'slug'=>[
            'nullable','alpha_dash','min:5','max:191',
            Rule::unique('posts')->ignore($id),
        ], */
    }


    protected function summernoteImage($description){
        // $description = '<head><meta http-equiv=\"Content-Type\" 
        // content=\"text/html; charset=utf-8\">
        // </head><body>' . $description . '</body>';
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        //$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->loadHtml(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            //dd(strpos($img->getAttribute('src'),'base64'));
            if(strpos($img->getAttribute('src'),'base64') != false) {
                $data = $img->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $filename = time().$k.'.png';
                \Storage::put('public/post_file/'.$filename,$data);
                $img->removeAttribute('src');
                $img->setAttribute('src', asset('storage/post_file/'.$filename));
            }
        }
        return $description = $dom->saveHTML();
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, $this->InsValidator($request));
        $slug = $this->postSlug($request->title);

        $post = new Post;
        $post->title=$request->title;
        $post->post_type=$request->post_type;
        $post->sort=$request->sort;
        $post->user_id=Auth::id();
        $post->slug=$slug;
        $post->save();

        if (!empty($request->body)){
            $description = $this->summernoteImage($request->body);
            $post->body=$description;
            $post->save();
        }

        $image = $request->file('image');
        if ($image) {
            $filename = $post->id.'.'.$image->extension();
            $full_path = 'post_file/'.$filename;
            $image->storeAs('public/post_file/', $filename);
            $post->image = $full_path;
            $post->save();
        }

        $post->taxonomy()->sync($request->categories);
        Session::flash('success','The Post was Successfully Save');

        if(array_key_exists('postMeta',$this->postType[$request->post_type])){
            $postmetas=array();
            foreach($request->postMeta as $key=>$postmeta){
                $postmetas[] = ['meta_key'=>$key,'meta_value'=>$postmeta];
            }
            $post->postMeta()->createMany($postmetas);
        }

        $url = route('posts.edit',$post->id);
        $url=$url.'?type='.$request->post_type;
        return redirect($url);
    }


    public function show($id)
    {
        $post=Post::find($id);
        return view('admin.posts.show')->withPost($post);
    }


    public function edit(Request $request, $id)
    {
        $post=Post::find($id);//->with('postMeta');
        $posttype=$this->postTypeCheck($request);
        $taxonomy = $this->taxByType($posttype['postType']);
        $mode='edit';
        return view('admin.posts.createOrEdit', compact('post','posttype','mode','taxonomy'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->InsValidator($request));

        $post=Post::find($id);
        $post->title=$request->input('title');
        $post->post_type=$request->input('post_type');
        $post->sort=$request->input('sort');
        $post->user_id=Auth::id();
        //$post->slug=$request->input('slug');
        //$post->category_id=$request->input('category_id');

        $image = $request->file('image');
        //dd($image); exit;
        if ($image) {
            $filename = $post->id.'.'.$image->extension();
            $full_path = 'post_file/'.$filename;
            $image->storeAs('public/post_file/', $filename);
            $post->image = $full_path;
        }
        $post->save();

        if (!empty($request->body)){
            $description = $this->summernoteImage($request->body);
            $post->body=$description;
            $post->save();
        }

        $post->taxonomy()->sync($request->categories);

        $post->postMeta()->delete();
        if(array_key_exists('postMeta',$this->postType[$request->post_type])){
            $postmetas=array();
            foreach($request->postMeta as $key=>$postmeta){
                $postmetas[] = ['meta_key'=>$key,'meta_value'=>$postmeta];
            }
            $post->postMeta()->createMany($postmetas);
        }

        Session::flash('success','The Post was Successfully Save');

        return redirect()->back();
    }

    public function postSort(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach($ids as $key=>$id){
            $data = Post::findOrFail($id);
            $data->sort = $key;
            $data->save();
        }
        return response()->json(array('msg'=> $ids), 200);
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        if(!empty($post->image)){
            \Storage::delete($post->image);
        }

        //Storage::delete(['file.jpg', 'file2.jpg']);
        $post->delete();
        Session::flash('success','Post was Successfully Deleted');
        return redirect()->route('posts.index');
    }
}
