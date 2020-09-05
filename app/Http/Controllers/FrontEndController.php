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
        $categories = Category::orderBy('created_at','asc')->take(3)->get();
        
        $category_name_1 = $categories[0]->name;
        $category_name_2 = $categories[1]->name;
        $category_name_3 = $categories[2]->name;

        return view('index')->with('title',Setting::first()->site_name)
                            ->with('categories',Category::take(5)->get())
                            ->with('first_post',Post::orderBy('created_at','desc')->first())
                            ->with('second_post',Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post',Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
                            ->with('category_name_1',Category::orderBy('created_at','desc')->where('name',$category_name_1)->get()->first())
                            ->with('category_name_2',Category::orderBy('created_at','desc')->where('name',$category_name_2)->get()->first())
                            ->with('category_name_3',Category::orderBy('created_at','desc')->where('name', $category_name_3)->get()->first())
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
    public function tag($id){
            $tag = Tag::find(['id'=>$id])->first();

            // dd($tag);
            return view('tag')->with('tag',$tag)
                                ->with('tags',Tag::take(5)->get())
                                ->with('categories',Category::take(5)->get())
                                ->with('setting',Setting::first())
                                ->with('title',Setting::first()->site_name)
                                ->with('tag_name',$tag->tag)
                                ->with('tags',Tag::all());

    }

    public function searchResult(){
        $post = Post::where('title','like','%' . request('query') . '%')->get();

        return view('search')->with('posts',$post)
                            ->with('tags',Tag::take(5)->get())
                            ->with('search_result',request('query'))
                            ->with('categories',Category::take(5)->get())
                            ->with('setting',Setting::first())
                            ->with('title',Setting::first()->site_name);
    }
}
