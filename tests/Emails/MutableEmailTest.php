<?php

namespace bkrukowski\TransparentEmail\Tests\Emails;

use bkrukowski\TransparentEmail\Emails\MutableEmail;
use bkrukowski\TransparentEmail\Emails\Email;
use bkrukowski\TransparentEmail\Emails\EmailInterface;

class MutableEmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerRemoveFromLocalPart
     *
     * @param EmailInterface $email
     * @param string $toRemove
     */
    public function testRemoveFromLocalPart(EmailInterface $email, string $toRemove)
    {
        $editable = new MutableEmail($email);
        $this->assertSame($editable, $editable->removeFromLocalPart($toRemove));
        $this->assertNotContains((string) $editable, $toRemove);
        $this->assertSame($email->getDomain(), $editable->getDomain());
    }

    public function providerRemoveFromLocalPart()
    {
        return [
            [new Email('jane.doe.1990@gmail.com'), '.'],
            [new Email('janedoe1990@gmail.com'), '.'],
        ];
    }

    /**
     * @dataProvider providerRemoveSuffixAlias
     *
     * @param EmailInterface $email
     * @param string $delimiter
     * @param string $expected
     */
    public function testRemoveSuffixAlias(EmailInterface $email, string $delimiter, string $expected)
    {
        $editable = new MutableEmail($email);
        $this->assertSame($editable, $editable->removeSuffixAlias($delimiter));
        $this->assertEquals($expected, $editable);
        $this->assertSame($email->getDomain(), $editable->getDomain());
    }

    public function providerRemoveSuffixAlias()
    {
        return [
            [new Email('John.Doe+alias@gmail.com', true), '+', 'John.Doe@gmail.com'],
            [new Email('JohnDoe-alias@gmail.com'), '-', 'johndoe@gmail.com'],
            [new Email('JohnDoe@gmail.com'), '-', 'johndoe@gmail.com'],
        ];
    }

    /**
     * @dataProvider providerSetDomain
     *
     * @param EmailInterface $email
     * @param string $domain
     */
    public function testSetDomain(EmailInterface $email, string $domain)
    {
        $editable = new MutableEmail($email);
        $this->assertSame($editable, $editable->setDomain($domain));
        $this->assertSame($domain, $editable->getDomain());
        $this->assertSame($email->getLocalPart(), $editable->getLocalPart());
    }

    public function providerSetDomain()
    {
        return [
            [new Email('jane.doe@foo.bar'), 'gmail.com'],
            [new Email('jane.doe@foo.bar'), 'foo.bar'],
            [new Email('jane.doe@gmail.com'), 'foo.bar'],
        ];
    }

    /**
     * @dataProvider providerSetLocalPart
     *
     * @param EmailInterface $email
     * @param string $localPart
     */
    public function testLocalPart(EmailInterface $email, string $localPart)
    {
        $editable = new MutableEmail($email);
        $this->assertSame($editable, $editable->setLocalPart($localPart));
        $this->assertSame($localPart, $editable->getLocalPart());
        $this->assertSame($email->getDomain(), $editable->getDomain());
    }

    public function providerSetLocalPart()
    {
        return [
            [new Email('jane.doe@foo.bar'), 'jane'],
            [new Email('jane.doe@foo.bar'), 'john'],
            [new Email('jane.doe@gmail.com'), 'jane.doe'],
        ];
    }

    /**
     * @dataProvider providerLowerCaseLocalPartIf
     *
     * @param EmailInterface $email
     * @param bool $condition
     * @param bool $expected
     */
    public function testLowerCaseLocalPartIf(EmailInterface $email, bool $condition, bool $expected)
    {
        $editable = new MutableEmail($email);
        $this->assertSame($editable, $editable->lowerCaseLocalPartIf($condition));
        $this->assertSame($expected, strtolower($editable->getLocalPart()) === $editable->getLocalPart());
        $this->assertSame($email->getDomain(), $editable->getDomain());
    }

    public function providerLowerCaseLocalPartIf()
    {
        return [
            [new Email('john.doe@example.com', true), false, true],
            [new Email('John.doe@example.com', true), false, false],
            [new Email('John.doe@example.com', true), true, true],
        ];
    }
}