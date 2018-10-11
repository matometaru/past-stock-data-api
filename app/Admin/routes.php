<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('stocks', StockController::class);
    $router->resource('datasets', DatasetController::class);
    $router->post('stocks/csv/import', 'StockController@import');
    $router->post('datasets/csv/import', 'DatasetController@import');

});
