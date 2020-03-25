<?php


Route::group(['prefix' => 'auth','middleware'=>'api', 'namespace'=>'Auth'], function () {
    Route::post('login', ['as'=>'login','uses'=>'LoginController@login']);
    Route::post('signup', ['as'=>'signup','uses'=>'LoginController@create']);
    Route::get('me', ['as'=>'me','uses'=>'LoginController@me']);
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

    //CONTACTS
    Route::get('company/{company}/contacts', 'CompanyContactController@index')->name('contacts.index');
    Route::post('company/contact', 'CompanyContactController@store')->name('contacts.store');
    Route::put('company/contact/{contact}', 'CompanyContactController@update')->name('contacts.update');
    Route::delete('company/contact/{contact}', 'CompanyContactController@destroy')->name('contacts.destroy');



    //USERS
    Route::get('/users', 'UserController@index')->name('user.index');
    Route::get('/users/{user}', 'UserController@show')->name('user.show');
    Route::get('/roles', 'UserController@roles')->name('user.show');
    Route::post('/users', 'UserController@store')->name('user.store');
    Route::put('/users/{user}', 'UserController@update')->name('user.update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('user.destroy');
});
