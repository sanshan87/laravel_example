<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});

Route::group(['prefix' => 'admin/blog', 'namespace' => 'Blog\Admin'], function () {
    Route::resource('categories', 'CategoryController')
        ->only(['index', 'create', 'store', 'edit', 'update'])
        ->names('admin.blog.categories');

    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('admin.blog.posts');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


