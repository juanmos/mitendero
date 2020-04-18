<?php

Route::post('company/suggestion', 'CompanySuggestionController@store');
Route::get('/companies/types', 'CompanyController@companyTypes')->name('company.types');

Route::group(['prefix' => 'auth','middleware'=>'api', 'namespace'=>'Auth'], function () {
    Route::post('login', ['as'=>'login','uses'=>'LoginController@login']);
    Route::post('signup/{type}', ['as'=>'signup','uses'=>'RegisterController@register']);
});

Route::group(['prefix' => 'auth','middleware'=>'auth:api', 'namespace'=>'Auth'], function () {
    Route::get('me', ['as'=>'me','uses'=>'LoginController@me']);
    Route::get('verify/user/{id}/{hash}', ['as'=>'verification.verify', 'uses' => 'VerificationController@verify' ]);
    Route::get('verify/resend', 'VerificationController@resend');
});


Route::group(['prefix' => 'profile','middleware'=>'auth:api'], function () {
    Route::put('/user', 'ProfileController@update')->name('profile.update');
});


Route::group(['middleware' => 'auth:api'], function () {
    //COMPANIES
    Route::get('/companies', 'CompanyController@index')->name('company.index');
    
    Route::post('/company', 'CompanyController@store')->name('company.store');
    Route::put('/company/{company}', 'CompanyController@update')->name('company.update');
    Route::get('company/{company}/users', 'CompanyController@users')->name('company.users');
    Route::put('/company/{company}/status/{status}', 'CompanyController@setStatus')->name('company.update.status');

    //COMPANY LOCATIONS
    Route::post('/company/{company}/location', 'CompanyLocationController@store')->name('company.location.store');

    //USERS
    Route::get('/users', 'UserController@index')->name('user.index');
    Route::get('/users/{user}', 'UserController@show')->name('user.show');
    Route::get('/roles', 'UserController@roles')->name('user.show');
    Route::post('/users', 'UserController@store')->name('user.store');
    Route::put('/users/{user}', 'UserController@update')->name('user.update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('user.destroy');

    //CATEGORIES
    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::get('category/{category}', 'CategoryController@show')->name('category.show');

    //CATEGORY PRODUCTS
    Route::get('/category/{category}/products/{paginate?}', 'ProductController@index')->name('category.products.index');
    Route::post('/category/{category}/product', 'ProductController@store')->name('category.product.store');
    Route::put('/category/{category}/product/{product}', 'ProductController@update')->name('category.product.update');
    Route::delete('/category/{category}/product/{product}', 'ProductController@destroy')->name('category.product.delete');


    Route::post('product/photo', 'ProductController@uploadPhoto')->name('product.upload');
    Route::get('/category/{category}/brands', 'ProductController@brands')->name('category.products.brands.list');

    //BRANDS
    Route::get('brands', 'BrandController@index')->name('brand.index');
    Route::get('brand/search/{term}', 'BrandController@search')->name('brand.search');
    Route::post('brand', 'BrandController@store')->name('brand.store');
    Route::put('brand/{brand}', 'BrandController@update')->name('brand.update');

    
    Route::group(['prefix' => 'my'], function () {
        Route::get('product/{product}', 'Company\ProductController@getProductInCompany')->name('my.company.product.getter');
        Route::post('product/{product}', 'Company\ProductController@setProductInCompany')->name('my.company.product.setter');
        Route::put('product/{product}/price', 'Company\ProductController@updateProductPrice')->name('my.company.product.price');
        Route::delete('product/{product}', 'Company\ProductController@removeProductInCompany')->name('my.company.product.remove');
    });
});
