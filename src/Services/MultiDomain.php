<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\EditableEmail;
use bkrukowski\TransparentEmail\Emails\EmailInterface;

abstract class MultiDomain implements ServiceInterface
{
    public function getPrimaryEmail(EmailInterface $email) : EmailInterface
    {
        return (new EditableEmail($email))
            ->setDomain($this->getPrimaryDomain())
            ->lowerCaseLocalPartIf(!$this->isCaseSensitive());
    }

    public function isSupported(EmailInterface $email) : bool
    {
        return in_array($email->getDomain(), $this->getDomainList(), true);
    }

    /**
     * @codeCoverageIgnore
     *
     * @return bool
     */
    protected function isCaseSensitive() : bool
    {
        return false;
    }

    /**
     * @return string Hostname in lowercase
     */
    abstract protected function getPrimaryDomain() : string;

    /**
     * @return array List of hostnames in lowercase
     */
    abstract protected function getDomainList() : array;
}