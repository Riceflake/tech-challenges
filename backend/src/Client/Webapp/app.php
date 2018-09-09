<?php
declare(strict_types=1);

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

$app = new Application();
$app['debug'] = true;

$app->register(new \IWD\JOBINTERVIEW\Client\Webapp\Services\SurveyService());

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
});
$app->get('/', function () use ($app) {
    return 'Status OK';
});

$app->mount('/', new \IWD\JOBINTERVIEW\Client\Webapp\Controllers\SurveyController());

$app->run();

return $app;
