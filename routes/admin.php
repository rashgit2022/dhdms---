<?php
use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware' =>'is_admin'], function(){
		Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
		Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
		Route::get('/admin/password/change', 'AdminController@PasswordChange')->name('admin.password.change');
		Route::get('/admin/password/update', 'AdminController@PasswordUpdate')->name('admin.password.update');

		
	//category routes
	Route:: group(['prefix'=>'category'], function(){
		Route::	get('/', 'CategoryController@index')->name('category.index');
		Route:: post('/store', 'CategoryController@store')->name('category.store');
		Route:: get('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
		Route:: get('/edit/{id}', 'CategoryController@edit');
		Route:: post('/update', 'CategoryController@update')->name('category.update');
	});

	//warehouse routes
	Route:: group(['prefix'=>'warehouse'], function(){
		Route::	get('/', 'WarehouseController@index')->name('warehouse.index');
		// Route:: post('/store', 'CategoryController@store')->name('category.store');
		// Route:: get('/delete/{id}', 'CategoryController@destroy')->name('category.delete');
		// Route:: get('/edit/{id}', 'CategoryController@edit');
		// Route:: post('/update', 'CategoryController@update')->name('category.update');
	});

	//coupon routes
	Route:: group(['prefix'=>'coupon'], function(){
		Route::	get('/', 'CouponController@index')->name('coupon.index');
		Route:: post('/store', 'CouponController@store')->name('store.coupon');
		Route:: delete('/delete/{id}', 'CouponController@destroy')->name('coupon.delete');
		Route:: get('/edit/{id}', 'CouponController@edit');
		Route:: post('/update', 'CouponController@update')->name('update.coupon');
	});

});