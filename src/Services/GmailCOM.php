<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
class GmailCOM implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        list($name, $domain) = explode('@', $email);

        return explode('+', str_replace('.', '', $name))[0] . '@' . $domain;
    }

    public function isDomainSupported(string $domain) : bool
    {
        return $domain === 'gmail.com';
    }
}