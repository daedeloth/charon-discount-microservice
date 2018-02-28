<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Api\V1\Controllers\Base\ResourceController;
use App\Http\Api\V1\ResourceDefinitions\DiscountResourceDefinition;
use App\Http\Api\V1\ResourceDefinitions\OrderResourceDefinition;
use App\Http\Middleware\TransformOrderToCharon;
use App\Models\Order;
use App\Services\DiscountService;
use CatLab\Charon\Collections\RouteCollection;
use CatLab\Charon\Enums\Action;

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
            [
                'middleware' => [ TransformOrderToCharon::class ]
            ],
            function(RouteCollection $routes) {

                $routes->post('calculateDiscounts', 'DiscountController@calculateDiscounts')
                    ->summary('Calculate discounts for a given order.')
                    ->parameters()->resource(OrderResourceDefinition::class)
                    ->returns()->many(DiscountResourceDefinition::class)
                ;
            }
        )->tag('discounts');
    }

    /**
     * DiscountController constructor.
     */
    public function __construct()
    {
        parent::__construct(DiscountResourceDefinition::class);
    }

    /**
     * @throws \CatLab\Charon\Exceptions\InvalidContextAction
     * @throws \CatLab\Charon\Exceptions\InvalidEntityException
     */
    public function calculateDiscounts()
    {
        $context = $this->getContext(Action::CREATE);

        // Turn json body into a resource
        $resource = $this->bodyToResource($context, OrderResourceDefinition::class);

        // Turn resources into entities, which we like to work with.
        $order = $this->toEntity($resource, $context, new Order(), OrderResourceDefinition::class);

        // We now have entities (= models), so we finally have something we can work with.

        // Collect all discounts
        $out = [];

        $discountService = new DiscountService();
        foreach ($discountService->getAll() as $discount) {
            if ($discount->isApplicable($order)) {
                $out[] = $discount;
            }
        }

        // We have all applicable discounts, now translate to resources again
        $readContext = $this->getContext(Action::VIEW, [ 'order' => $order ]);
        $resources = $this->toResources($out, $readContext);

        // And send to the client.
        return $this->toResponse($resources);

        // NOTE: It wouldn't be too hard to return the final order price here, but
        // since it wasn't requested I'm just returning all the discounts (and their final amount)
        // in a list. It suffices to just sum all "discount" properties of each discount item
        // in order to receive the full discount.
    }
}