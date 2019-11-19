<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

abstract class AbstractFilter implements FilterInterface
{
    /**
     * The value.
     *
     * @var string|int|float
     */
    private $value;

    /**
     * Create a new filter.
     *
     * @param string|int|float $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function value()
    {
        return $this->value;
    }
}
