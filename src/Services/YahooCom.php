<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
class YahooCom implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        list($name, $domain) = explode('@', strtolower($email));

        return explode('-', $name, 2)[0] . '@' . $domain;
    }

    public function isDomainSupported(string $domain) : bool
    {
        return strtolower($domain) === 'yahoo.com';
    }
}