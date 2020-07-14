<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){
        // $s = Category::orderBy('created_at','desc')->where('name','wordpress')->get()->first();
        // dd($s->posts);
        return view('index')->with('title',Setting::first()->site_name)
                            ->with('categories',Category::take(5)->get())
                            ->with('first_post',Post::orderBy('created_at','desc')->first())
                            ->with('second_post',Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post',Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
                            ->with('wordpress',Category::orderBy('created_at','desc')->where('name','wordpress')->get()->first())
                            ->with('node_js',Category::orderBy('created_at','desc')->where('name','Node Js')->get()->first())
                            ->with('codeig_niter',Category::orderBy('created_at','desc')->where('name','Codeigniter')->get()->first())
                            ->with('setting',Setting::first());
    }

    public function singlePost($slug){

        $post = Post::where(['slug'=>$slug])->first();

        $next_id = Post::where('id', '>', $post->id)->min('id');
        $pre_id = Post::where('id', '<', $post->id)->max('id');
        // dd(Post::find($pre_id)->first());
        return view('single')->with('post',$post)
                            ->with('categories',Category::take(5)->get())
                            ->with('setting',Setting::first())
                            ->with('title',Setting::first()->site_name)
                            ->with('next_post',Post::find($next_id))
                            ->with('pre_post',Post::find($pre_id))
                            ->with('tags',Tag::all());
    }
                        
    public function category($id){
            $category = Category::find(['id'=>$id])->first();

            // dd($category);
            return view('category')->with('category',$category)
                                ->with('categories',Category::take(5)->get())
                                ->with('setting',Setting::first())
                                ->with('title',Setting::first()->site_name)
                                ->with('category_name',$category->name)
                                ->with('tags',Tag::all());

    }
}
