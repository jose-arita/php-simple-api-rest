<?php

require_once "router.php";


route('/', function () {
    require_once __DIR__ . '/pages/home.php';
});

route('api/user', function () {
    require_once __DIR__ . '/api-rest/user.php';
});


$action = $_SERVER['REQUEST_URI'];

dispatch($action);
