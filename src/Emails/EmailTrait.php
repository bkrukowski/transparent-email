<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Emails;

trait EmailTrait
{
    private $localPart;

    private $domain;

    public function getLocalPart() : string
    {
        return $this->localPart;
    }

    public function getDomain() : string
    {
        return $this->domain;
    }

    public function __toString() : string
    {
        return $this->localPart . '@' . $this->domain;
    }
}