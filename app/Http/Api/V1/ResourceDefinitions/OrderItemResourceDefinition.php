<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\OrderItem;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class OrderItemResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class OrderItemResourceDefinition extends ResourceDefinition
{
    public function __construct()
    {
        parent::__construct(OrderItem::class);

        $this->field('productId')
            ->display('product-id')
            ->string()
            ->writeable(true, true)
            ->visible(true, true)
        ;

        $this->field('quantity')
            ->number()
            ->writeable(true, true)
            ->visible(true, true)
        ;

        $this->field('price')
            ->number()
            ->writeable(true, true)
            ->visible(true, true)
            ->display('unit-price');

        // Why tf would you need this anyway?
        $this->field('total')
            ->number()
            ->writeable(true, true)
            ->visible(true, true)
            ->display('total');
    }
}