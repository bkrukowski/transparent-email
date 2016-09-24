<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\EditableEmail;
use bkrukowski\TransparentEmail\Emails\EmailInterface;

class YahooCom implements ServiceInterface
{
    public function getPrimaryEmail(EmailInterface $email) : EmailInterface
    {
        return (new EditableEmail($email))
            ->removeSuffixAlias('-')
            ->lowerCaseLocalPartIf(true);
    }

    public function isSupported(EmailInterface $email) : bool
    {
        return $email->getDomain() === 'yahoo.com';
    }
}