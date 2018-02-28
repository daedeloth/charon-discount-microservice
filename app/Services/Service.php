<?php

namespace App\Services;

use App\Models\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Service
 * @package App\Services
 */
abstract class Service
{
    /**
     * @var Model[]
     */
    private $items;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        // Collections are cool.
        $this->items = new Collection([]);
    }

    /**
     * @param string $file File in /data directory
     */
    protected function loadData($file)
    {
        $data = json_decode(
            file_get_contents(base_path('data/' . $file))
        );

        foreach ($data as $v) {
            $this->add($this->toModel($v));
        }
    }

    /**
     * Add an item.
     * @param Model $model
     */
    protected function add(Model $model)
    {
        $this->items[] = $model;
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function getFromId($id)
    {
        return $this->items->where('id', '=', $id)->first();
    }

    /**
     * Translate data to a model.
     * @param $data
     * @return Model
     */
    abstract function toModel($data) : Model;
}