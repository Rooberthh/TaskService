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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('tasks',  ['uses' => 'TasksController@index']);
    $router->post('tasks',  ['uses' => 'TasksController@store']);
    $router->patch('tasks/{id}',  ['uses' => 'TasksController@update']);
    $router->delete('tasks/{id}',  ['uses' => 'TasksController@destroy']);

    $router->get('statuses',  ['uses' => 'StatusesController@index']);
    $router->patch('statuses/{id}',  ['uses' => 'StatusesController@update']);
    $router->post('statuses',  ['uses' => 'StatusesController@store']);
    $router->delete('statuses/{id}',  ['uses' => 'StatusesController@destroy']);

    $router->post('tasks/{task}/objectives',  ['uses' => 'TaskObjectivesController@store']);
});
