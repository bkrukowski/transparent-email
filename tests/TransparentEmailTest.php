<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Tests;

use bkrukowski\TransparentEmail\Emails\Email;
use bkrukowski\TransparentEmail\ServiceCollector;
use bkrukowski\TransparentEmail\ServiceCollectorInterface;
use bkrukowski\TransparentEmail\Services\TlenPl;
use bkrukowski\TransparentEmail\TransparentEmail;

class TransparentEmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerGetPrimaryEmail
     *
     * @param TransparentEmail $transparentEmail
     * @param string $email
     * @param string $expectedEmail
     * @param bool $caseSensitive
     */
    public function testGetPrimaryEmail(
        TransparentEmail $transparentEmail,
        string $email,
        string $expectedEmail,
        bool $caseSensitive = false
    ) {
        $this->assertEquals($expectedEmail, $transparentEmail->getPrimaryEmail(new Email($email, $caseSensitive)));
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
            [new TransparentEmail($emptyServiceCollector), 'John.Doe@example.com', 'John.Doe@example.com', true],
            [new TransparentEmail(), 'John.Doe@gmail.com', 'johndoe@gmail.com', true],
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