<?php

declare(strict_types=1);

namespace DigipolisGent\Flanders\BasicRegisters\Uri;

use DigipolisGent\API\Client\Uri\UriInterface;
use DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId;

/**
 * URI to get the details of a post info.
 */
class PostInfoDetailUri implements UriInterface
{
    /**
     * The post info id.
     *
     * @var \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId
     */
    private $postInfoId;

    /**
     * Create a new URI by passing the StreetNameId value.
     *
     * @param \DigipolisGent\Flanders\BasicRegisters\Value\Post\PostInfoId $postInfoId
     */
    public function __construct(PostInfoId $postInfoId)
    {
        $this->postInfoId = $postInfoId;
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return sprintf('postinfo/%d', $this->postInfoId->value());
    }
}
