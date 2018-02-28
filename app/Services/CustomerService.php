<?php

/*
 * All services are hacked together very quickly.
 * This could be replaced by a nice error-handling api client.
 * But now it's just loading local json files, so hey, it's okay.
 */

namespace App\Services;

use App\Models\Customer;
use App\Models\Model;

/**
 * Class CustomerService
 * @package App\Services
 */
class CustomerService extends Service
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
        $this->loadData('customers.json');
    }

    /**
     * Translate data to a model.
     * @param $data
     * @return Model
     */
    function toModel($data): Model
    {
        return new Customer($data);
    }
}