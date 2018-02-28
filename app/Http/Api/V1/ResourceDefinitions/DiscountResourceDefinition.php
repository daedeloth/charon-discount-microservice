<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Discount;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class DiscountResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class DiscountResourceDefinition extends ResourceDefinition
{
    /**
     * DiscountResourceDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Discount::class);


    }
}