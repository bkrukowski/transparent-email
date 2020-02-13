<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Emails\Email;
use bkrukowski\TransparentEmail\Services\MailRU;
use PHPUnit\Framework\TestCase;

class MailRUTest extends TestCase
{
    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param string $inputEmail
     * @param string $outputEmail
     */
    public function testGetPrimaryEmail(string $inputEmail, string $outputEmail)
    {
        $this->assertEquals($outputEmail, (new MailRU())->getPrimaryEmail(new Email($inputEmail)));
    }

    public function providerGetPrimaryEmail() : array
    {
        return [
            ['foobar@MAIL.RU', 'foobar@mail.ru'],
            ['fOObar@MaiL.Ru', 'foobar@mail.ru'],
            ['foobar+alias@mail.ru', 'foobar@mail.ru'],
        ];
    }

    /**
     * @dataProvider providerIsSupported
     *
     * @param string $domain
     * @param bool $result
     */
    public function testIsSupported(string $domain, bool $result)
    {
        $this->assertSame($result, (new MailRU())->isSupported(new Email('Jane.Doe@' . $domain)));
    }

    public function providerIsSupported() : array
    {
        return [
            ['mail.ru', true],
            ['mail.RU', true],
            ['MAIL.RU', true],
            ['ma.il.ru', false],
        ];
    }
}