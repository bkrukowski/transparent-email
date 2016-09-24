<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\EditableEmail;
use bkrukowski\TransparentEmail\Emails\EmailInterface;

class GmailCom implements ServiceInterface
{
    public function getPrimaryEmail(EmailInterface $email) : EmailInterface
    {
        return (new EditableEmail($email))
            ->removeFromLocalPart('.')
            ->removeSuffixAlias('+')
            ->lowerCaseLocalPartIf(true)
            ->setDomain($this->mapDomain($email->getDomain()));
    }

    public function isSupported(EmailInterface $email) : bool
    {
        return in_array($email->getDomain(), ['gmail.com', 'googlemail.com']);
    }

    protected function getDomainMapping() : array
    {
        return [
            'googlemail.com' => 'gmail.com',
        ];
    }

    private function mapDomain(string $domain) : string
    {
        return $this->getDomainMapping()[$domain] ?? $domain;
    }
}