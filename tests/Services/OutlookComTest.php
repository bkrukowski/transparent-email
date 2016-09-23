<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Services\OutlookCom;

class OutlookComTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsDomainSupported
     *
     * @param string $domain
     * @param bool $result
     */
    public function testIsDomainSupported(string $domain, bool $result)
    {
        $this->assertSame($result, (new OutlookCom())->isDomainSupported($domain));
    }

    public function providerIsDomainSupported()
    {
        return [
            ['outlook.com', true],
            ['Outlook.Com', true],
            ['hotmail.com', true],
            ['HotMail.COM', true],
            ['gmail.com', false],
            ['tlen.pl', false],
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
        $this->assertSame($expectedEmail, (new OutlookCom())->getPrimaryEmail($inputEmail));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            ['janedoe@outlook.com', 'janedoe@outlook.com'],
            ['jane.doe@outlook.com', 'jane.doe@outlook.com'],
            ['Jane.Doe@Outlook.Com', 'jane.doe@outlook.com'],
            ['Jane.Doe+alias@OUTLOOK.COM', 'jane.doe@outlook.com'],
            ['Jane.Doe+Hotmail@hotmail.com', 'jane.doe@hotmail.com'],
        ];
    }
}