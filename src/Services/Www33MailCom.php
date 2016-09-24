<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\MutableEmail;
use bkrukowski\TransparentEmail\Emails\EmailInterface;

class Www33MailCom implements ServiceInterface
{
    public function getPrimaryEmail(EmailInterface $email) : EmailInterface
    {
        return (new MutableEmail($email))
            ->setLocalPart(preg_replace('/\\.33mail\\.com$/', '', $email->getDomain()));
    }

    public function isSupported(EmailInterface $email) : bool
    {
        return (bool) preg_match('/\\.33mail\\.com$/', $email->getDomain());
    }
}