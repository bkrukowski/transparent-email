<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
class WWW33MailCOM implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        list(, $domain) = explode('@', $email);

        return preg_replace('/\\.33mail\\.com$/', '', $domain) . '@' . $domain;
    }

    public function isDomainSupported(string $domain) : bool
    {
        return (bool) preg_match('/\\.33mail\\.com$/', $domain);
    }
}