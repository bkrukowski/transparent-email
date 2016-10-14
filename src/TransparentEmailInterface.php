<?php

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Emails\EmailInterface;

interface TransparentEmailInterface
{
    public function getPrimaryEmail(EmailInterface $email) : EmailInterface;
}