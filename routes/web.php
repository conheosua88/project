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

// Route::get('/', function () {
//     return view('welcome');
// });

/*========================= Admin==================================*/
Route::get('admin','admin\AdminController@index');
Route::get('admin/login','admin\AdminController@login');
Route::post('admin/login','admin\AdminController@postlogin');
Route::get('admin/logout','admin\AdminController@logout');
Route::get('admin/taikhoan','admin\AdminController@taikhoan');
Route::post('admin/taikhoan','admin\AdminController@posttaikhoan');

/*============================Display=================================      */
Route::get('admin/display','admin\TourDuLich_DanhMucController@index');



/*============================Tour Du Lịch================================*/
Route::get('admin/tourdulich/danhmuc','admin\TourDuLich_DanhMucController@index');
Route::post('admin/tourdulich/themdanhmuc','admin\TourDuLich_DanhMucController@store');
Route::delete('admin/tourdulich/xoadanhmuc/{id}','admin\TourDuLich_DanhMucController@destroy');
Route::get('admin/tourdulich/danhsach/{id}','admin\TourDuLich_DanhMucController@edit');
Route::post('admin/tourdulich/suadanhmuc/{id}','admin\TourDuLich_DanhMucController@update');
Route::get('admin/tourdulich/search_category/{ten_tieude}/{page}/{limit}','admin\TourDuLich_DanhMucController@search');
/*Đăng bài*/
Route::get('admin/tourdulich','admin\TourDuLichController@index')->name('list_travel');
Route::get('admin/tourdulich/create','admin\TourDuLichController@create');
Route::get('admin/tourdulich/back','admin\TourDuLichController@back');
Route::post('admin/tourdulich/create','admin\TourDuLichController@store');
Route::get('admin/tourdulich/edit/{id}','admin\TourDuLichController@edit');
Route::post('admin/tourdulich/edit/{id}','admin\TourDuLichController@update');
Route::delete('admin/tourdulich/delete/{id}','admin\TourDuLichController@destroy');
Route::get('admin/tourdulich/search_travel/{ten_tieude}/{ten_chude}/{page}/{limit}','admin\TourDuLichController@search_travel');
Route::post('admin/tourdulich/status/{id}','admin\TourDuLichController@status');
/*Địa điểm*/
Route::get('admin/tourdulich/place','admin\PlaceController@index');
Route::post('admin/tourdulich/add_place','admin\PlaceController@store');
Route::delete('admin/tourdulich/delete_place/{tag}','admin\PlaceController@destroy');
Route::get('admin/tourdulich/list/{tag}','admin\PlaceController@edit');
Route::post('admin/tourdulich/edit_place/{id}','admin\PlaceController@update');



/*================================Tin tức =============================*/
Route::get('admin/tintuc/danhmuc','admin\TinTuc_DanhMucController@index');
Route::post('admin/tintuc/themdanhmuc','admin\TinTuc_DanhMucController@store');
Route::delete('admin/tintuc/xoadanhmuc/{id}','admin\TinTuc_DanhMucController@destroy');
Route::get('admin/tintuc/danhsach/{id}','admin\TinTuc_DanhMucController@edit');
Route::post('admin/tintuc/suadanhmuc/{id}','admin\TinTuc_DanhMucController@update');
Route::get('admin/tintuc/search_category/{ten_tieude}/{page}/{limit}','admin\TinTuc_DanhMucController@search');
/*Đăng bài*/
Route::get('admin/tintuc','admin\TinTucController@index')->name('list_new');
Route::get('admin/tintuc/create','admin\TinTucController@create');
Route::get('admin/tintuc/back','admin\TinTucController@back');
Route::post('admin/tintuc/create','admin\TinTucController@store');
Route::get('admin/tintuc/edit/{id}','admin\TinTucController@edit');
Route::post('admin/tintuc/edit/{id}','admin\TinTucController@update');
Route::delete('admin/tintuc/delete/{id}','admin\TinTucController@destroy');
Route::get('admin/tintuc/search_new/{ten_tieude}/{ten_chude}/{page}/{limit}','admin\TinTucController@search_new');


/*================================Giao diện=======================================*/
Route::get('/','giaodien\PagesController@trangchu');
Route::get('{url}','giaodien\PagesController@post');
Route::get('search_tour','giaodien\PagesController@search');
Route::post('booking_user','giaodien\PagesController@booking_user');
Route::post('contact','giaodien\PagesController@contact');
Route::get('{category}/{url}','giaodien\PagesController@tintuc');

