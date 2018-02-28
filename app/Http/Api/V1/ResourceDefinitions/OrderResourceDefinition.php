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
    }
}