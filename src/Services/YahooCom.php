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
        $explodedName = explode('-', $name, 2);

        return $explodedName[0] . (count($explodedName) === 2 ? '-alias' : '') . '@' . $domain;
    }

    public function isDomainSupported(string $domain) : bool
    {
        return strtolower($domain) === 'yahoo.com';
    }
}