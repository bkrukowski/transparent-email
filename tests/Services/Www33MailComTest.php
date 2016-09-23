<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Services\Www33MailCom;

class Www33MailComTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsDomainSupported
     *
     * @param string $domain
     * @param bool $isSupported
     */
    public function testIsDomainSupported(string $domain, bool $isSupported)
    {
        $this->assertSame($isSupported, (new Www33MailCom())->isDomainSupported($domain));
    }

    public function providerIsDomainSupported()
    {
        return [
            ['foo.33mail.com', true],
            ['bar.33mail.com', true],
            ['bar.33Mail.Com', true],
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
        $this->assertSame($expectedEmail, (new Www33MailCom())->getPrimaryEmail($inputEmail));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            ['qwerty@name.33mail.com', 'name@name.33mail.com'],
            ['lorem@ipsum.33mail.com', 'ipsum@ipsum.33mail.com'],
            ['lorem@Ipsum.33mail.com', 'ipsum@ipsum.33mail.com'],
        ];
    }
}