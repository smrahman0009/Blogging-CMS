<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
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
}
