<?php

namespace bkrukowski\TransparentEmail\Emails;

interface EmailInterface
{
    public function getLocalPart() : string;

    /**
     * @return string Domain in lowercase
     */
    public function getDomain() : string;

    public function __toString() : string;
}