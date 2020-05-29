<?php

use Illuminate\Routing\Router;

$router = app(Router::class);

$router->get('/', function () {
    return view('welcome');
});

Auth::routes();

$router->get('/home', 'HomeController@index')->name('home');
