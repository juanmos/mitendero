<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ApplicationController@web');
// Route::get('/{any}', 'ApplicationController')->where('any', '.*');
// Auth::routes(['verify'=>true]);
