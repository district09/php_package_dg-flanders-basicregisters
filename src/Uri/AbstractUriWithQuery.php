<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;

/**
 * Abstract URI with support for Filters & Pager.
 */
abstract class AbstractUriWithQuery implements UriInterface
{
    /**
     * The request query parameters.
     *
     * @var array
     */
    private $query;

    /**
     * URI with only filters.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     *
     * @return \DigipolisGent\API\Client\Uri\UriInterface
     */
    public static function fromFilters(?FiltersInterface $filters = null): UriInterface
    {
        $uri = new static();
        $uri->query = $filters ? $filters->filters() : [];

        return $uri;
    }

    /**
     * URI with only pager.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     *
     * @return \DigipolisGent\API\Client\Uri\UriInterface
     */
    public static function fromPager(?PagerInterface $pager = null): UriInterface
    {
        $uri = new static();
        $uri->query = $pager ? $pager->query() : [];

        return $uri;
    }

    /**
     * From Filters & Pager.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface|null $filters
     *   Optional filters to limit the list by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface|null $pager
     *   Optional pager to limit the list by.
     *
     * @return \DigipolisGent\API\Client\Uri\UriInterface
     */
    public static function fromFiltersAndPager(
        ?FiltersInterface $filters = null,
        ?PagerInterface $pager = null
    ): UriInterface {
        $query = array_merge(
            $filters ? $filters->filters() : [],
            $pager ? $pager->query() : []
        );

        $uri = new static();
        $uri->query = array_filter($query);

        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return $this->addQueryString($this->getPath());
    }

    /**
     * Get the base path (without query parameters) for the URI.
     *
     * @return string
     */
    abstract protected function getPath(): string;

    /**
     * Helper to add the query string to the URI.
     *
     * @param string $uri
     *
     * @return string
     */
    protected function addQueryString(string $uri): string
    {
        if (!$this->query) {
            return $uri;
        }

        return sprintf(
            '%s?%s',
            $uri,
            http_build_query($this->query)
        );
    }
}
