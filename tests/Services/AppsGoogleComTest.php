<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Services\AppsGoogleCom;

class AppsGoogleComTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsDomainSupported
     *
     * @param string $domain
     * @param bool $result
     */
    public function testIsDomainSupported(string $domain, bool $result)
    {
        $this->assertSame($result, (new AppsGoogleCom())->isDomainSupported($domain));
    }

    public function providerIsDomainSupported()
    {
        return [
            ['example.com', false],
            ['krukowski.me', true],
        ];
    }
}