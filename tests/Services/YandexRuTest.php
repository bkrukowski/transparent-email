<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests\Services;

use bkrukowski\TransparentEmail\Emails\Email;
use bkrukowski\TransparentEmail\Services\YandexRu;
use PHPUnit\Framework\TestCase;

class YandexRuTest extends TestCase
{
    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param string $inputEmail
     * @param string $outputEmail
     */
    public function testGetPrimaryEmail(string $inputEmail, string $outputEmail)
    {
        $this->assertEquals($outputEmail, (new YandexRu())->getPrimaryEmail(new Email($inputEmail)));
    }

    public function providerGetPrimaryEmail() : array
    {
        return [
            ['foobar@YANDEX.RU', 'foobar@yandex.ru'],
            ['fOObar@YAndEX.ru', 'foobar@yandex.ru'],
            ['foobar+alias@yandex.ru', 'foobar@yandex.ru'],
            ['JaneDoe@ya.ru', 'janedoe@yandex.ru'],
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
        $this->assertSame($result, (new YandexRu())->isSupported(new Email('Jane.Doe@' . $domain)));
    }

    public function providerIsSupported() : array
    {
        return [
            ['yandex.ru', true],
            ['yandex.RU', true],
            ['yan.dex.ru', false],
            ['YANDEX.RU', true],
        ];
    }
}