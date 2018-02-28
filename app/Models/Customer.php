<?php

namespace App\Models;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $since;

    /**
     * @var double
     */
    protected $revenue;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function setId(int $id): Customer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSince(): \DateTime
    {
        return $this->since;
    }

    /**
     * @param \DateTime $since
     * @return Customer
     */
    public function setSince(\DateTime $since): Customer
    {
        $this->since = $since;
        return $this;
    }

    /**
     * @return float
     */
    public function getRevenue(): float
    {
        return $this->revenue;
    }

    /**
     * @param float $revenue
     * @return Customer
     */
    public function setRevenue(float $revenue): Customer
    {
        $this->revenue = $revenue;
        return $this;
    }
}