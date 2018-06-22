<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

// ROTALAR
require '../src/routes/ogrenci.php';
require '../src/routes/servis.php';
require '../src/routes/firma.php';
require '../src/routes/okul.php';
require '../src/routes/ucret.php';
require '../src/routes/login.php';
require '../src/routes/konum.php';
require '../src/routes/konumonay.php';
 
$app->run();