<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\EmailInterface;

class AppsGoogleCom extends GmailCom
{
    public function isSupported(EmailInterface $email) : bool
    {
        getmxrr($email->getDomain(), $mxhosts);
        $regex1 = '#\\.googlemail\\.com$#';
        $regex2 = '#\\.google\\.com$#';
        foreach ($mxhosts as $host) {
            if (preg_match($regex1, $host) || preg_match($regex2, $host)) {
                return true;
            }
        }

        return false;
    }
}