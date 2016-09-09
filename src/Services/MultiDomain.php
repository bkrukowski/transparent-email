<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
abstract class MultiDomain implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        return explode('@', $email)[0] . '@' . $this->getPrimaryDomain();
    }

    public function isDomainSupported(string $domain) : bool
    {
        return in_array($domain, $this->getDomainList());
    }

    abstract protected function getPrimaryDomain() : string;

    abstract protected function getDomainList() : array;
}