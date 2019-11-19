<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Filter;

/**
 * Collection of filters.
 */
final class Filters implements FiltersInterface
{
    /**
     * The added filters.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Filter\FilterInterface[]
     */
    private $filters;

    /**
     * Create new filters collection from Filter objects.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FilterInterface ...$filters
     */
    public function __construct(FilterInterface ...$filters)
    {
        $this->filters = $filters;
    }

    /**
     * @inheritDoc
     */
    public function filters(): array
    {
        $filters = [];
        foreach ($this->filters as $filter) {
            $filters[$filter->name()] = $filter->value();
        }

        return $filters;
    }
}
