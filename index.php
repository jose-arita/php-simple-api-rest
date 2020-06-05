<?php

require_once "router.php";


route('/', function () {
    require_once __DIR__ . '/pages/home.php';
});


$action = $_SERVER['REQUEST_URI'];

dispatch($action);
