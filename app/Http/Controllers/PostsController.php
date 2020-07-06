<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index')->with('posts',Post::all());
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
        return view('admin.post.create')->with('categories',$categories);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'featured' => 'required|image',
            'category_id' => 'required',
            'content' => 'required'
        ]);
        
        $featured = $request->featured;
        
        $featured_new_name = time() . $featured->getClientOriginalName();
        
        $featured->move('uploads/posts',$featured_new_name);
        
        $post = Post::create(
            [
                'title' => $request->title,
                'featured' => 'uploads/posts/' . $featured_new_name,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->title,'-'),
                ]
            );
            
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
        //
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
        //
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
        $posts = Post::onlyTrashed()->get();

        return view('admin.post.trashed')->with('posts',$posts);
    }

    public function kill($id)
    {
        $post = Post::onlyTrashed()->where(['id' => $id])->first();

        $post->forceDelete();
        toastr()->success('Post deleted permanently.');
        return redirect()->back();
    }
}
