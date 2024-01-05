<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['middleware' => 'basicAuth'], function() use ($router){
    $router->get('/kategori','KategoriController@index');
    $router->post('/kategori','KategoriController@create');
    $router->get('/kategori/{id}','KategoriController@detail');
    $router->get('/kategori/{id}/produk','KategoriController@count');
    $router->put('/kategori/{id}','KategoriController@update');
    $router->delete('/kategori/{id}','KategoriController@delete');
    $router->get('/getkategori','KategoriController@getkategori');

    $router->get('/produk','ProdukController@index');
    $router->get('/produk/{id}/count','ProdukController@count');
    $router->post('/produk','ProdukController@create');
    $router->get('/produk/{id}','ProdukController@detail');
    $router->put('/produk/{id}','ProdukController@update');
    $router->delete('/produk/{id}','ProdukController@delete');

    $router->get('/cart','CartController@index');
    $router->post('/cart','CartController@create');
    $router->get('/cart/{id}','CartController@detail');
    $router->put('/cart/{id}','CartController@update');
    $router->delete('/cart/{id}','CartController@delete');
    $router->put('/cart/{id}/bayar','CartController@bayar');
    $router->get('/cart-daycount','CartController@daycount');
    $router->get('/cart-terbaru','CartController@terbaru');

    $router->get('/cartdetail','CartDetailController@index');
    $router->post('/cartdetail','CartDetailController@create');
    $router->get('/cartdetail/{id}','CartDetailController@detail');
    $router->put('/cartdetail/{id}','CartDetailController@update');
    $router->delete('/cartdetail/{id}','CartDetailController@delete');

});

