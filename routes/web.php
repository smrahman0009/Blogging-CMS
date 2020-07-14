<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontEndController@index')->name('index');

Route::get('/post/{slug}','FrontEndController@singlePost')->name('single-post');

Route::get('/test/',function () {
    return Auth::user()->profile->is_admin;
    return User::find(1)->profile;
});

Auth::routes();


Route::group(['middleware' => 'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profiles', 'ProfilesController@index')->name('user-profile');
    Route::post('/profile/update/', 'ProfilesController@update')->name('user-profile-update');
    Route::get('/profile/destroy/{id}', 'ProfilesController@destroy')->name('profile-delete');

    Route::get('posts', 'PostsController@index')->name('posts');
    Route::get('/post/create', 'PostsController@create')->name('post-create');
    Route::post('/post/store', 'PostsController@store')->name('post-store');
    Route::get('/post/destroy/{id}', 'PostsController@destroy')->name('post-delete');
    Route::get('/post/trashed', 'PostsController@trashed')->name('post-trashed');
    Route::get('/post/kill/{id}', 'PostsController@kill')->name('post-kill');
    Route::get('/post/restore/{id}', 'PostsController@restore')->name('post-restore');
    Route::get('/post/edit/{id}', 'PostsController@edit')->name('post-edit');
    Route::post('/post/update/{id}', 'PostsController@update')->name('post-update');
    
    Route::get('/categories', 'CategoriesController@index')->name('categories');
    Route::get('/category/create', 'CategoriesController@create')->name('category-create');
    Route::post('/category/store', 'CategoriesController@store')->name('category-store');
    Route::post('/category/update/{id}', 'CategoriesController@update')->name('category-update');
    Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category-edit');
    Route::get('/category/destroy/{id}', 'CategoriesController@destroy')->name('category-delete');

    Route::group(['middleware' => 'admin'],function(){
        Route::get('/users', 'UserController@index')->name('users');
        Route::get('/user/create', 'UserController@create')->name('user-create');
        Route::post('/user/store', 'UserController@store')->name('user-store');
        Route::post('/user/update/{id}', 'UserController@update')->name('user-update');
        Route::get('/user/edit/{id}', 'UserController@edit')->name('user-edit');
        Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user-delete');

        Route::get('/setting', 'SettingsController@index')->name('setting');
        Route::post('/setting/update', 'SettingsController@update')->name('setting-update');
    });

    Route::get('/tags', 'TagsController@index')->name('tags');
    Route::get('/tag/create', 'TagsController@create')->name('tag-create');
    Route::post('/tag/store', 'TagsController@store')->name('tag-store');
    Route::post('/tag/update/{id}', 'TagsController@update')->name('tag-update');
    Route::get('/tag/edit/{id}', 'TagsController@edit')->name('tag-edit');
    Route::get('/tag/destroy/{id}', 'TagsController@destroy')->name('tag-delete');

});