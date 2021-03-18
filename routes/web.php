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
//Admin
Route::get('/admin', 'LoginController@index');
Route::get('/admin/info', 'InfoController@index');
Route::get('/admin/category', 'CategoryController@index');
Route::get('/admin/product', 'ProductController@index');
Route::get('/admin/product-order', 'ProductController@indexOrder');
Route::get('/admin/news', 'NewsController@index');
Route::get('/admin/slide', 'SlideController@index');
Route::get('/logout', 'LoginController@logout');
//Action
Route::post('/admin/login', 'LoginController@login');
Route::post('/admin/info/save', 'InfoController@save');

Route::post('/admin/category/left-content', 'CategoryController@leftContent');
Route::post('/admin/category/detail', 'CategoryController@detail');
Route::post('/admin/category/save', 'CategoryController@save');
Route::post('/admin/category/delete', 'CategoryController@delete');

Route::post('/admin/product/left-content', 'ProductController@leftContent');
Route::post('/admin/product/detail', 'ProductController@detail');
Route::post('/admin/product/save', 'ProductController@save');
Route::post('/admin/product/delete', 'ProductController@delete');
Route::post('/admin/product/save-order', 'ProductController@saveOrder');

Route::post('/admin/news/left-content', 'NewsController@leftContent');
Route::post('/admin/news/detail', 'NewsController@detail');
Route::post('/admin/news/save', 'NewsController@save');
Route::post('/admin/news/delete', 'NewsController@delete');

Route::post('/admin/slide/left-content', 'SlideController@leftContent');
Route::post('/admin/slide/detail', 'SlideController@detail');
Route::post('/admin/slide/save', 'SlideController@save');
Route::post('/admin/slide/delete', 'SlideController@delete');

//Home Page
Route::get('/', 'HomeController@index');
//Product Home
Route::get('/product', 'ProductController@indexPage');
Route::get('/product/{ctg_id}', 'ProductController@indexCategory');
Route::get('/product/detail/{id}', 'ProductController@detailPage');
//News Page
Route::get('/news', 'NewsController@indexPage');
Route::get('/news/{id}', 'NewsController@detailPage');
//Map Page
Route::get('/map', 'MapController@index');

//Refer link
Route::get('/haidepzai', 'ReferController@index');
Route::post('/haidepzai/left-content', 'ReferController@leftContent');
Route::post('/haidepzai/detail', 'ReferController@detail');
Route::post('/haidepzai/save', 'ReferController@save');
Route::post('/haidepzai/delete', 'ReferController@delete');
//
Route::get('/refer/{id}', 'ReferController@detailPage');