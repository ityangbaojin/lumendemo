<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['namespace' => 'App\Http\Controllers\home'], function($app) {
    resource('user', 'UserController');
    // $app->get('user', 'UserController@index');
});

$app->get('index', function () use ($app) {
    return view('index', ['name' => 'Lumen']);
});


// 模拟 RESTful 控制器
function resource($uri, $controller) {
    //$verbs = array('GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE');
    global $app;
    $app->get($uri, $controller . '@index');
    $app->get($uri . '/create', $controller . '@create');
    $app->post($uri, $controller . '@store');
    $app->get($uri . '/{id}', $controller . '@show');
    $app->get($uri . '/{id}/edit', $controller . '@edit');
    $app->put($uri . '/{id}', $controller . '@update');
    $app->patch($uri . '/{id}', $controller . '@update');
    $app->delete($uri . '/{id}', $controller . '@destroy');
}