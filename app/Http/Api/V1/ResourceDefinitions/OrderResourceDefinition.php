<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Order;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class OrderResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class OrderResourceDefinition extends ResourceDefinition
{
    /**
     * OrderResourceDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Order::class);

        $this->identifier('id')
            ->writeable(true, true);

        $this->field('customerId')
            ->display('customer-id')
            ->int()
            ->writeable(true, true)
            ->visible(true, true);

        $this->relationship('items', OrderItemResourceDefinition::class)
            ->display('items')
            ->writeable(true, true)
            ->visible(true, true);

        $this->field('total')
            ->writeable(true, true)
            ->number()
            ->visible(true, true);
    }
}