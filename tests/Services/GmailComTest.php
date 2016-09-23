<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Services\GmailCom;

class GmailComTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param string $inputEmail
     * @param string $outputEmail
     */
    public function testGetPrimaryEmail(string $inputEmail, string $outputEmail)
    {
        $this->assertSame($outputEmail, (new GmailCom())->getPrimaryEmail($inputEmail));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            ['foo.bar@gmail.com', 'foobar@gmail.com'],
            ['Foo.Bar@GMAIL.COM', 'foobar@gmail.com'],
            ['foobar+alias@gmail.com', 'foobar@gmail.com'],
            ['fo.ob.ar+alias@gmail.com', 'foobar@gmail.com'],
            ['JaneDoe@googlemail.com', 'janedoe@gmail.com'],
        ];
    }

    /**
     * @dataProvider providerIsDomainSupported
     *
     * @param string $domain
     * @param bool $result
     */
    public function testIsDomainSupported(string $domain, bool $result)
    {
        $this->assertSame($result, (new GmailCom())->isDomainSupported($domain));
    }

    public function providerIsDomainSupported()
    {
        return [
            ['gmail.com', true],
            ['gmail.COM', true],
            ['google.com', false],
            ['gmailcom', false],
            ['g.mail.com', false]
        ];
    }
}