<?php

namespace App\Services;

use App\Models\Model;
use App\Models\Product;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends Service
{
    /**
     * CategoryService constructor.
     */
    public function __construct()
    {
        // it we don't do this the whole thing crashes down.
        parent::__construct();

        // Going very dirty route just to get this working.
        // There should be some error handling here, but hey, I'm doing this for free.
        $this->loadData('products.json');
    }

    /**
     * Translate data to a model.
     * @param $data
     * @return Model
     */
    function toModel($data): Model
    {
        return new Product($data);
    }
}