<?php

/**
 * WHAAT? A second route file specific to this API version?
 * Not even using the Laravel router? Why?!
 * Because of swagger documentation and I didn't want Charon to be
 * laravel-dependant.
 */

use CatLab\Charon\Collections\RouteCollection;

$routes = new RouteCollection();

$routes
    ->get('/api/v1/description.{format?}', 'Api\V1\Controllers\DescriptionController@description')
    ->summary('Get swagger API description')
    ->tag('swagger')
;

/**
 * Everything related to the API.
 */
$routes->group(
    [
        'prefix' => '/api/v1/',
        'suffix' => '.{format?}',
        'namespace' => 'Api\V1\Controllers',
        'middleware' => [
            'web',
            'auth', // temporary
            \CatLab\Charon\Laravel\Middleware\ResourceToOutput::class
        ],
        'security' => [
            [
                'oauth2' => [
                    'full'
                ]
            ]
        ]
    ],
    function(RouteCollection $routes)
    {

        // Format parameter goes for all endpoints.
        $routes->parameters()->path('format')->enum(['json'])->describe('Output format')->default('json');



    }
);

return $routes;