<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests;

use bkrukowski\TransparentEmail\DefaultServiceCollector;
use bkrukowski\TransparentEmail\Services\ServiceInterface;

class DefaultServiceCollectorTest extends \PHPUnit_Framework_TestCase
{
    public function testIterator()
    {
        $atLeastOne = false;
        foreach (new DefaultServiceCollector() as $service) {
            $atLeastOne = true;
            $this->assertInstanceOf(ServiceInterface::class, $service);
        }
        $this->assertTrue($atLeastOne);
    }
}