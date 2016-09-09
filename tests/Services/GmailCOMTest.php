<?php

namespace bkrukowski\Gordianus\Tests\Services;

use bkrukowski\Gordianus\Services\GmailCOM;

class GmailCOMTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param string $inputEmail
     * @param string $outputEmail
     */
    public function testGetPrimaryEmail(string $inputEmail, string $outputEmail)
    {
        $this->assertSame($outputEmail, (new GmailCOM())->getPrimaryEmail($inputEmail));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            ['foo.bar@gmail.com', 'foobar@gmail.com'],
            ['Foo.Bar@GMAIL.COM', 'foobar@gmail.com'],
            ['foobar+alias@gmail.com', 'foobar@gmail.com'],
            ['fo.ob.ar+alias@gmail.com', 'foobar@gmail.com'],
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
        $this->assertSame($result, (new GmailCOM())->isDomainSupported($domain));
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