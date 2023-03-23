<?php

/**
 * @var $router Core\Router
 */
$router->get('', 'BaseController@index');
$router->get('blog', 'BaseController@index');
$router->get('blog/create', 'BaseController@create');
$router->post('blog/store', 'BaseController@store');
$router->get('blog/edit', 'BaseController@edit');
$router->post('blog/edit', 'BaseController@update');
$router->get('blog/delete', 'BaseController@delete');
