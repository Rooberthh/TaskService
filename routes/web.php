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

    $router->get('boards',  ['uses' => 'BoardsController@index']);
    $router->post('boards',  ['uses' => 'BoardsController@store']);
    $router->patch('boards/{id}',  ['uses' => 'BoardsController@update']);
    $router->delete('boards/{id}',  ['uses' => 'BoardsController@destroy']);

    $router->get('boards/{board}/statuses',  ['uses' => 'StatusesController@index']);
    $router->post('boards/{board}/statuses',  ['uses' => 'StatusesController@store']);
    $router->patch('boards/{board}/statuses/{id}',  ['uses' => 'StatusesController@update']);
    $router->delete('boards/{board}/statuses/{id}',  ['uses' => 'StatusesController@destroy']);

    $router->get('tasks/{task}/objectives',  ['uses' => 'TaskObjectivesController@index']);
    $router->post('tasks/{task}/objectives',  ['uses' => 'TaskObjectivesController@store']);
    $router->patch('tasks/{task}/objectives/{objective}',  ['uses' => 'TaskObjectivesController@update']);
    $router->delete('tasks/{task}/objectives/{objective}',  ['uses' => 'TaskObjectivesController@destroy']);
});
