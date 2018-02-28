<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Bet you haven't seen this before...
// Yes, translating charon routes to laravel routes because YOLO.
// (Routes are cached in production so this does not influence performance)
$routeTransformer = new \CatLab\Charon\Laravel\Transformers\RouteTransformer();

/** @var \CatLab\Charon\Collections\RouteCollection $routeCollection */
$routeCollection = include __DIR__ . '/../app/Http/Api/V1/routes.php';
$routeTransformer->transform($routeCollection);