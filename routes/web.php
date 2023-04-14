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

//unsecure routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users',['uses' => 'UserController@getUsers']);
});

// more simple routes
$router->get('/user',['uses' => 'UserController@index']);

$router->post('/auser', 'UserController@addUsers'); // create new user record

$router->get('/guser/{id}', 'UserController@showUsers'); // get user by id

$router->put('/uuser/{id}', 'UserController@updateUsers'); // update user record

$router->patch('/uuser/{id}', 'UserController@updateUsers'); // update user record

$router->delete('/duser/{id}', 'UserController@deleteUsers'); // delete record 