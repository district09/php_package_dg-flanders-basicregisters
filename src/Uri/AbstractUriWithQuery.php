<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\FiltersInterface;
use DigipolisGent\Flanders\BasicRegisters\Pager\PagerInterface;

/**
 * Abstract URI with support for Filters & Pager.
 */
abstract class AbstractUriWithQuery implements UriWithFiltersAndPagerInterface
{
    /**
     * The request query parameters.
     *
     * @var array
     */
    private $query;

    /**
     * @inheritDoc
     */
    final public static function fromFilters(?FiltersInterface $filters = null): UriInterface
    {
        // @phpstan-ignore-next-line
        $uri = new static();
        $uri->query = $filters ? $filters->filters() : [];

        return $uri;
    }

    /**
     * @inheritDoc
     */
    final public static function fromPager(?PagerInterface $pager = null): UriInterface
    {
        // @phpstan-ignore-next-line
        $uri = new static();
        $uri->query = $pager ? $pager->query() : [];

        return $uri;
    }

    /**
     * @inheritDoc
     */
    final public static function fromFiltersAndPager(
        ?FiltersInterface $filters = null,
        ?PagerInterface $pager = null
    ): UriInterface {
        $query = array_merge(
            $filters ? $filters->filters() : [],
            $pager ? $pager->query() : []
        );

        // @phpstan-ignore-next-line
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
