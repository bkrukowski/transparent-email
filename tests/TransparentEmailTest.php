<?php

namespace bkrukowski\TransparentEmail\Tests;

use bkrukowski\TransparentEmail\ServiceCollector;
use bkrukowski\TransparentEmail\ServiceCollectorInterface;
use bkrukowski\TransparentEmail\Services\TlenPl;
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
     * @param TransparentEmail $transparentEmail
     * @param string $email
     * @param string $expectedEmail
     */
    public function testGetPrimaryEmail(TransparentEmail $transparentEmail, string $email, string $expectedEmail)
    {
        $this->assertSame($expectedEmail, $transparentEmail->getPrimaryEmail($email));
    }

    public function providerGetPrimaryEmail()
    {
        $emptyServiceCollector = $this->createServiceCollector();
        $tlenServiceCollector = $this->createServiceCollector([TlenPl::class]);

        return [
            [
                new TransparentEmail($tlenServiceCollector),
                'john.doe+alias@gmail.com',
                'john.doe+alias@gmail.com'
            ],
            [new TransparentEmail(), 'john.doe+alias@gmail.com', 'johndoe@gmail.com'],
            [new TransparentEmail($emptyServiceCollector), 'John.Doe@example.com', 'john.doe@example.com'],
            [new TransparentEmail($emptyServiceCollector, true), 'John.Doe@example.com', 'John.Doe@example.com'],
            [new TransparentEmail(null, true), 'John.Doe@gmail.com', 'johndoe@gmail.com'],
            [new TransparentEmail(), 'Jane.Doe+receipts@hotmail.com', 'jane.doe@hotmail.com'],
            [new TransparentEmail(), 'Jane.Doe-receipts@yahoo.com', 'jane.doe@yahoo.com'],
        ];
    }

    private function createServiceCollector(array $classes = []) : ServiceCollectorInterface
    {
        $collector = new ServiceCollector();
        foreach ($classes as $class) {
            $collector->addService(new $class());
        }

        return $collector;
    }
}