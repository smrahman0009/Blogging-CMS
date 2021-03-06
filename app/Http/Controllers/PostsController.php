<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Flysystem\File;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(7);
        return view('admin.post.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        if(!$categories->count()){
            toastr()->info('You need to create some category fist.');
            return redirect()->route('category-create');
        }
        return view('admin.post.create')->with('categories',$categories)
                                        ->with('tags',Tag::all());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'title' => 'required',
            'featured' => 'required|image',
            'category_id' => 'required',
            'content' => 'required'
        ]);
        
        $featured = $request->featured;
        
        $featured_new_name = time() . $featured->getClientOriginalName();

      
        $featured->move('uploads/posts',$featured_new_name);
        
        $image_path = public_path("/uploads/posts/". $featured_new_name);
        $img = Image::make($image_path)->resize(1920, 1080, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($image_path);


        $post = Post::create(
            [
                'title' => $request->title,
                'featured' => 'uploads/posts/' . $featured_new_name,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->title,'-'),
                'user_id' => Auth::id()
                ]
            );

        $post->tags()->attach($request->tags);
            
        toastr()->success('Post created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.post.edit')->with('post',$post)->with('categories',Category::all())
                                                            ->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->tags);
        $this->validate($request,[
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ]);
        
        $post = Post::find($id);

        if($request->hasFile('featured')){
            
            $featured = $request->featured;
            
            $featured_new_name = time() . $featured->getClientOriginalName();
            
            $featured->move('uploads/posts',$featured_new_name);

            $image_path = public_path("/uploads/posts/" . $featured_new_name);
            $img = Image::make($image_path)->resize(1920, 1080, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($image_path);
            unlink($post->featured);
            $post->featured = 'uploads/posts/' . $featured_new_name;
        }
        
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        /*******  SYNC post_tag table   *******/
        if($request->tags){
            DB::table('post_tag')->where(['post_id' => $post->id])->delete();
            $post->tags()->attach($request->tags);
        }
        /**************************************/
        $post->save();

        toastr()->success('Post updatted successfully');
        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();
        toastr()->success('Post trashed successfully');
        return redirect()->back();
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(7);

        return view('admin.post.trashed')->with('posts',$posts);
    }

    public function kill($id)
    {
        $post = Post::onlyTrashed()->where(['id' => $id])->first();
        unlink($post->featured);

        $post->forceDelete();
        toastr()->success('Post deleted permanently.');
        return redirect()->back();
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->where(['id' => $id])->first();

        $post->restore();
        toastr()->success('Post restore successfully.');
        return redirect()->route('posts');
    }
}
