<?php

namespace bkrukowski\Gordianus\Tests\Services;

use bkrukowski\Gordianus\Services\WWW33MailCOM;

class WWW33MailCOMTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsDomainSupported
     *
     * @param string $domain
     * @param bool $isSupported
     */
    public function testIsDomainSupported(string $domain, bool $isSupported)
    {
        $this->assertSame($isSupported, (new WWW33MailCOM())->isDomainSupported($domain));
    }

    public function providerIsDomainSupported()
    {
        return [
            ['foo.33mail.com', true],
            ['bar.33mail.com', true],
            ['foo.34mail.com', false],
            ['foo33mail.com', false],
        ];
    }

    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param string $inputEmail
     * @param string $expectedEmail
     */
    public function testGetPrimaryEmail(string $inputEmail, string $expectedEmail)
    {
        $this->assertSame($expectedEmail, (new WWW33MailCOM())->getPrimaryEmail($inputEmail));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            ['qwerty@name.33mail.com', 'name@name.33mail.com'],
            ['lorem@ipsum.33mail.com', 'ipsum@ipsum.33mail.com'],
        ];
    }
}