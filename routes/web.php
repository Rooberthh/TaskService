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
    $router->get('boards',  ['uses' => 'BoardsController@index']);
    $router->post('boards',  ['uses' => 'BoardsController@store']);
    $router->get('boards/{id}',  ['uses' => 'BoardsController@show']);
    $router->patch('boards/{id}',  ['uses' => 'BoardsController@update']);
    $router->delete('boards/{id}',  ['uses' => 'BoardsController@destroy']);

    $router->get('boards/{board}/statuses',  ['uses' => 'StatusesController@index']);
    $router->post('boards/{board}/statuses',  ['uses' => 'StatusesController@store']);
    $router->patch('boards/{board}/statuses/{id}',  ['uses' => 'StatusesController@update']);
    $router->delete('boards/{board}/statuses/{id}',  ['uses' => 'StatusesController@destroy']);

    $router->get('statuses/{status}/tasks',  ['uses' => 'TasksController@index']);
    $router->post('statuses/{status}/tasks',  ['uses' => 'TasksController@store']);
    $router->patch('statuses/{status}/tasks/{id}',  ['uses' => 'TasksController@update']);
    $router->delete('statuses/{status}/tasks/{id}',  ['uses' => 'TasksController@destroy']);

    $router->get('tasks/{task}/objectives',  ['uses' => 'TaskObjectivesController@index']);
    $router->post('tasks/{task}/objectives',  ['uses' => 'TaskObjectivesController@store']);
    $router->patch('tasks/{task}/objectives/{id}',  ['uses' => 'TaskObjectivesController@update']);
    $router->delete('tasks/{task}/objectives/{id}',  ['uses' => 'TaskObjectivesController@destroy']);
});
