<?php

Route::post('company/suggestion', 'CompanySuggestionController@store');

Route::group(['prefix' => 'auth','middleware'=>'api', 'namespace'=>'Auth'], function () {
    Route::post('login', ['as'=>'login','uses'=>'LoginController@login']);
    Route::post('signup/{type}', ['as'=>'signup','uses'=>'RegisterController@register']);
    Route::get('me', ['as'=>'me','uses'=>'LoginController@me']);
    Route::get('verify/user/{id}/{hash}', ['as'=>'verification.verify', 'uses' => 'VerificationController@verify' ]);
    Route::get('verify/resend', 'VerificationController@resend');
});

Route::group(['prefix' => 'profile','middleware'=>'api'], function () {
    Route::put('/user', 'ProfileController@update')->name('profile.update');
});


Route::group(['middleware' => 'api'], function () {
    //COMPANIES
    Route::get('/companies', 'CompanyController@index')->name('company.index');
    Route::get('/companies/types', 'CompanyController@companyTypes')->name('company.types');
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
});
