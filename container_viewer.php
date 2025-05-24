<?php
require_once __DIR__ . '/functions.php';

// url param 'v' for view part to include to main container
// $view = isset($_GET["v"]) ? $_GET["v"] : "home";

// set the routes with desire path
$views = [
    "/" => '/views/home/index.php',
    "/about" => '/views/about/index.php',
    "/activities" => "views/activities/index.php",
    "/daily_activities" => "/views/daily_activities/index.php",
    "/media" => '/views/media/index.php',
];

// this will include require container to main container
load_view($views);