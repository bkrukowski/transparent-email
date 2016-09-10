<?php

namespace bkrukowski\TransparentEmail\Tests;

use bkrukowski\TransparentEmail\TransparentEmail;
use bkrukowski\TransparentEmail\InvalidEmailException;

class TransparentEmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerValidator
     *
     * @param string $email
     * @param bool $validEmail
     */
    public function testValidator(string $email, bool $validEmail)
    {
        if (!$validEmail) {
            $this->expectException(InvalidEmailException::class);
        }
        (new TransparentEmail())->getPrimaryEmail($email);
    }

    public function providerValidator()
    {
        return [
            ['john.doe@gmail.comm', true],
            ['john doe@gmail.com', false],
        ];
    }

    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param TransparentEmail $TransparentEmail
     * @param string $email
     * @param string $expectedEmail
     */
    public function testGetPrimaryEmail(TransparentEmail $TransparentEmail, string $email, string $expectedEmail)
    {
        $this->assertSame($expectedEmail, $TransparentEmail->getPrimaryEmail($email));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            [new TransparentEmail([TransparentEmail::SERVICE_TLEN_PL]), 'john.doe+alias@gmail.com', 'john.doe+alias@gmail.com'],
            [new TransparentEmail(), 'john.doe+alias@gmail.com', 'johndoe@gmail.com'],
            [new TransparentEmail([]), 'John.Doe@example.com', 'john.doe@example.com'],
            [new TransparentEmail([], true), 'John.Doe@example.com', 'John.Doe@example.com'],
            [new TransparentEmail(TransparentEmail::ALL_SERVICES, true), 'John.Doe@gmail.com', 'johndoe@gmail.com'],
            [new TransparentEmail(), 'Jane.Doe+receipts@hotmail.com', 'jane.doe@hotmail.com'],
            [new TransparentEmail(), 'Jane.Doe-receipts@yahoo.com', 'jane.doe@yahoo.com'],
        ];
    }
}