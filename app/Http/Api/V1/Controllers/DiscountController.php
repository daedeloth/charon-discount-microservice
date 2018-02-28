<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Controllers\Base\ResourceController;
use App\Http\Api\V1\ResourceDefinitions\DiscountResourceDefinition;
use App\Http\Api\V1\ResourceDefinitions\OrderResourceDefinition;
use CatLab\Charon\Collections\RouteCollection;

/**
 * Class DiscountController
 * @package App\Http\Api\V1\Controllers
 */
class DiscountController extends ResourceController
{
    /**
     * Settings routes in your controller? For realsies?!
     * Yes, it does make sense when you think about it.
     * @param RouteCollection $routes
     */
    public static function setRoutes(RouteCollection $routes)
    {
        // Why the group? Just showing off really.
        // The tag method at the end of the group statement applies to all routes
        // specified within the group.
        // This is a feature I stole from Laravel.
        $routes->group(
            [],
            function(RouteCollection $routes) {

                $routes->post('calculateDiscounts', 'DiscountController@calculateDiscounts')
                    ->summary('Calculate discounts for a given order.')
                    ->parameters()->resource(OrderResourceDefinition::class)
                    ->returns()->many(DiscountResourceDefinition::class);

            }
        )->tag('discounts');
    }

    /**
     *
     */
    public function calculateDiscounts()
    {

    }
}