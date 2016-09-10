<?php

namespace bkrukowski\TransparentEmail\Services;

/**
 * @internal
 */
interface ServiceInterface
{
    public function isDomainSupported(string $domain) : bool;

    public function getPrimaryEmail(string $email) : string;
}