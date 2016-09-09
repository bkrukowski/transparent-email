<?php

namespace bkrukowski\Gordianus\Tests;

use bkrukowski\Gordianus\Gordianus;
use bkrukowski\Gordianus\InvalidEmailException;

class GordianusTest extends \PHPUnit_Framework_TestCase
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
        (new Gordianus())->getPrimaryEmail($email);
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
     * @param Gordianus $gordianus
     * @param string $email
     * @param string $expectedEmail
     */
    public function testGetPrimaryEmail(Gordianus $gordianus, string $email, string $expectedEmail)
    {
        $this->assertSame($expectedEmail, $gordianus->getPrimaryEmail($email));
    }

    public function providerGetPrimaryEmail()
    {
        return [
            [new Gordianus([Gordianus::SERVICE_TLEN_PL]), 'john.doe+alias@gmail.com', 'john.doe+alias@gmail.com'],
            [new Gordianus(), 'john.doe+alias@gmail.com', 'johndoe@gmail.com'],
        ];
    }
}