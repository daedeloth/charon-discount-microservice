<?php

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Discounts\AbstractDiscount;
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
        parent::__construct(AbstractDiscount::class);

        $this->field('reason')
            ->visible(true, true);

        $this->field('discount:{context.order}')
            ->display('discount')
            ->visible(true, true);
    }
}