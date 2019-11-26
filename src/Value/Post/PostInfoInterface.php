<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Value\Post;

use DigipolisGent\Value\ValueInterface;

/**
 * Post info value.
 */
interface PostInfoInterface extends ValueInterface
{
    /**
     * Get the post info id.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    public function postInfoId(): PostInfoId;

    /**
     * Get the postal code.
     *
     * @return int
     */
    public function postalCode(): int;

    /**
     * Get all the post info names.
     *
     * @return \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoNames
     */
    public function postInfoNames(): PostInfoNames;

    /**
     * Get the default name of the object.
     *
     * This will return the PostInfoNames::name() value.
     *
     * @return string
     */
    public function name(): string;
}
