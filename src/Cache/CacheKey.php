<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Cache;

use DigipolisGent\Flanders\BasicRegisters\Value\AbstractId;

/**
 * Value containing the cache key.
 */
final class CacheKey
{
    /**
     * The cache key string.
     *
     * @var string
     */
    private $value;

    /**
     * Create the cache key from a given string.
     *
     * The "FlandersBasicRegister" prefix will be added automatically.
     *
     * @param string
     *   The cache key string without the "FlandersBasicRegister" prefix.
     */
    public function __construct(string $value)
    {
        $this->value = sprintf('FlandersBasicRegister:%s', $value);
    }

    /**
     * Create a cache key from an ID object.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\AbstractId $identifier
     *   The identifier.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Cache\CacheKey
     */
    public static function fromId(AbstractId $identifier): CacheKey
    {
        $className = get_class($identifier);
        preg_match('#\\\\(\w+)$#', $className, $matches);

        return new static(
            sprintf('%s:%s', $matches[1], $identifier)
        );
    }

    /**
     * Get the key value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Convert the key to a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
