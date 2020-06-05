<?php

$routes = [];

function route($action, Closure $callback)
{
    global $routes;
    $action = explode('/', $action);
    if (is_numeric(end($action))) {
        array_pop($action);
    }
    $action = implode($action);
    $routes[$action] = $callback;
}

function dispatch($action)
{
    global $routes;
    $action = explode('/', $action);
    if (is_numeric(end($action))) {
        array_pop($action);
    }
    $action = implode($action);
    if ($routes[$action]) {
        $callback = $routes[$action];
        echo call_user_func($callback);
    } else {
        require_once __DIR__ . '/pages/404.php';
    }
}
