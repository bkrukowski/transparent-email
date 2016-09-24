<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Emails\Email;
use bkrukowski\TransparentEmail\Services\YahooCom;

class YahooComTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsSupported
     *
     * @param string $domain
     * @param bool $result
     */
    public function testIsDomainSupported(string $domain, bool $result)
    {
        $this->assertSame($result, (new YahooCom())->isSupported(new Email('Jane.Doe@' . $domain, true)));
    }

    public function providerIsSupported()
    {
        return [
            ['yahoo.com', true],
            ['Yahoo.Com', true],
            ['YAHOO.COM', true],
            ['hotmail.com', false],
            ['HotMail.COM', false],
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
        $this->assertEquals($expectedEmail, (new YahooCom())->getPrimaryEmail(new Email($inputEmail, true)));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            ['janedoe@yahoo.com', 'janedoe@yahoo.com'],
            ['jane.doe@yahoo.com', 'jane.doe@yahoo.com'],
            ['Jane.Doe@Yahoo.Com', 'jane.doe@yahoo.com'],
            ['Jane.Doe+receipts@YAHOO.COM', 'jane.doe+receipts@yahoo.com'],
            ['Jane.Doe-receipts@YAHOO.COM', 'jane.doe@yahoo.com'],
            ['Jane.Doe-spam-alias@YAHOO.COM', 'jane.doe@yahoo.com'],
        ];
    }
}