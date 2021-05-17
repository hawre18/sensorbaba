<?php

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

Route::prefix('admins')->group(function (){
    Route::get('attributes.delete/{id}','App\Http\Controllers\Admin\AttributeGroupController@delete')->name('attributes.delete');
    Route::resource('attributes','App\Http\Controllers\Admin\AttributeGroupController');
    Route::get('attributes-value.delete/{id}','App\Http\Controllers\Admin\AttributeValueController@delete')->name('attributes-value.delete');
    Route::resource('attributes-value','App\Http\Controllers\Admin\AttributeValueController');
    Route::get('categories.delete/{id}','App\Http\Controllers\Admin\CategoryController@delete')->name('categories.delete');
    Route::get('categories.indexSetting/{id}','App\Http\Controllers\Admin\CategoryController@indexSetting')->name('categories.indexSetting');
    Route::post('categories.saveSetting/{id}','App\Http\Controllers\Admin\CategoryController@saveSetting');
    Route::resource('categories','App\Http\Controllers\Admin\CategoryController');
    Route::get('brands.delete/{id}','App\Http\Controllers\Admin\BrandController@delete')->name('brands.delete');
    Route::resource('brands','App\Http\Controllers\Admin\BrandController');
    Route::post('photos/upload','App\Http\Controllers\Admin\PhotoController@upload')->name('photos.upload');
    Route::resource('photos','App\Http\Controllers\Admin\PhotoController');
});
