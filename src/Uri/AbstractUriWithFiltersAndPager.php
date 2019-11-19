<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Filter\Filters;
use DigipolisGent\Flanders\BasicRegisters\Pager\Pager;

/**
 * Abstract URI with support for Filters & Pager.
 */
abstract class AbstractUriWithFiltersAndPager implements UriInterface
{
    /**
     * The request query parameters.
     *
     * @var array
     */
    private $query;

    /**
     * Construct a new URI.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Filter\Filters|null $filters
     *   Optional filters to limit the list by.
     * @param \DigipolisGent\Flanders\BasicRegisters\Pager\Pager|null $pager
     *   Optional pager to limit the list by.
     */
    public function __construct(?Filters $filters = null, ?Pager $pager = null)
    {
        $query = [
            $filters ? $filters->filters() : [],
            $pager ? ['offset' => $pager->offset(), 'limit' => $pager->limit()] : [],
        ];

        $this->query = array_merge(...$query);
    }

    /**
     * @inheritDoc
     */
    public function getUri()
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
