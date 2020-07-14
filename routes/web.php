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

Route::get('/category/{id}','FrontEndController@category')->name('category-single');

Route::get('/tag/{id}','FrontEndController@tag')->name('tag-single');

Route::get('/search','FrontEndController@searchResult')->name('search-result');

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

    Route::get('posts_', 'PostsController@index')->name('posts');
    Route::get('/post_/create', 'PostsController@create')->name('post-create');
    Route::post('/post_/store', 'PostsController@store')->name('post-store');
    Route::get('/post_/destroy/{id}', 'PostsController@destroy')->name('post-delete');
    Route::get('/post_/trashed', 'PostsController@trashed')->name('post-trashed');
    Route::get('/post_/kill/{id}', 'PostsController@kill')->name('post-kill');
    Route::get('/post_/restore/{id}', 'PostsController@restore')->name('post-restore');
    Route::get('/post_/edit/{id}', 'PostsController@edit')->name('post-edit');
    Route::post('/post_/update/{id}', 'PostsController@update')->name('post-update');
    
    Route::get('/categories_', 'CategoriesController@index')->name('categories');
    Route::get('/category_/create', 'CategoriesController@create')->name('category-create');
    Route::post('/category_/store', 'CategoriesController@store')->name('category-store');
    Route::post('/category_/update/{id}', 'CategoriesController@update')->name('category-update');
    Route::get('/category_/edit/{id}', 'CategoriesController@edit')->name('category-edit');
    Route::get('/category_/destroy/{id}', 'CategoriesController@destroy')->name('category-delete');

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

    Route::get('/tags_', 'TagsController@index')->name('tags');
    Route::get('/tag_/create', 'TagsController@create')->name('tag-create');
    Route::post('/tag_/store', 'TagsController@store')->name('tag-store');
    Route::post('/tag_/update/{id}', 'TagsController@update')->name('tag-update');
    Route::get('/tag_/edit/{id}', 'TagsController@edit')->name('tag-edit');
    Route::get('/tag_/destroy/{id}', 'TagsController@destroy')->name('tag-delete');

});