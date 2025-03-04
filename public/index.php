<?php

require __DIR__ . '/../vendor/autoload.php';

header('Content-type: application/json');

$app = new App\App();
$app->handleRequest();
