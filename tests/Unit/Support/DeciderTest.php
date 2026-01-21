<?php

namespace Tests\Unit\Support;

use IFresh\PackageHealth\Support\Decider;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class DeciderTest extends TestCase
{
    /** @test */
    public function it_returns_true_when_environment_is_set_to_production()
    {
        $this->app['env'] = 'production';

        $result = (new Decider)->shouldPost();

        assertTrue($result);
    }

    /** @test */
    public function it_returns_false_when_environment_is_not_set_to_production()
    {
        $this->app['env'] = 'foobar';

        $result = (new Decider)->shouldPost();

        assertFalse($result);
    }
}
