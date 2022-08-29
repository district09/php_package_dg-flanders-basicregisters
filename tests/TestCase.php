<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters;

use Prophecy\PhpUnit\ProphecyTrait;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

/**
 * Test case with support for Prophecy.
 */
abstract class TestCase extends PhpUnitTestCase
{
    use ProphecyTrait;
}
