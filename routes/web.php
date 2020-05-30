<?php

use Illuminate\Routing\Router;

$router = app(Router::class);

$router->get('/', function () {
    return view('welcome');
});

Auth::routes();

$router->get('/home', 'HomeAction')->name('home');
$router->post('/upload-xml', 'UploadFileAction')->name('upload');
