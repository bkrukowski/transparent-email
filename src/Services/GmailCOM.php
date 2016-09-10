<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
class GmailCom implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        list($name, $domain) = explode('@', strtolower($email));

        return explode('+', str_replace('.', '', $name))[0] . '@' . $domain;
    }

    public function isDomainSupported(string $domain) : bool
    {
        return strtolower($domain) === 'gmail.com';
    }
}