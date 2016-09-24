<?php

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\EmailInterface;

interface ServiceInterface
{
    public function isSupported(EmailInterface $email) : bool;

    public function getPrimaryEmail(EmailInterface $email) : EmailInterface;
}