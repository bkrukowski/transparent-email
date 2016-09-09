<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @internal
 */
abstract class MultiDomain implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        if (!$this->isCaseSensitive()) {
            $email = strtolower($email);
        }
        return explode('@', $email)[0] . '@' . $this->getPrimaryDomain();
    }

    public function isDomainSupported(string $domain) : bool
    {
        return in_array(strtolower($domain), $this->getDomainList());
    }

    /**
     * @codeCoverageIgnore
     *
     * @return bool
     */
    protected function isCaseSensitive() : bool
    {
        return false;
    }

    abstract protected function getPrimaryDomain() : string;

    abstract protected function getDomainList() : array;
}