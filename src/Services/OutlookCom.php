<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
class OutlookCom implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        list($name, $domain) = explode('@', strtolower($email));

        return explode('+', $name)[0] . '@' . $domain;
    }

    public function isDomainSupported(string $domain) : bool
    {
        return in_array(strtolower($domain), ['outlook.com', 'hotmail.com']);
    }
}