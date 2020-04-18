<?php

Route::get('/categories', 'CategoryController@index')->name('category.index');
Route::get('/category/{category}', 'CategoryController@show')->name('category.show');
Route::get('/category/{category}/products/{paginate?}', 'ProductController@index')->name('category.products.index');
Route::get('/category/{category}/brands', 'ProductController@brands')->name('category.products.brands.list');
