<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Emails;

/**
 * @internal
 */
class MutableEmail implements EmailInterface
{
    use EmailTrait;

    public function __construct(EmailInterface $email)
    {
        $this->localPart = $email->getLocalPart();
        $this->domain = $email->getDomain();
    }

    public function removeFromLocalPart(string $toRemove) : MutableEmail
    {
        $this->localPart = str_replace($toRemove, '', $this->localPart);

        return $this;
    }

    public function removeSuffixAlias(string $delimiter) : MutableEmail
    {
        $this->localPart = explode($delimiter, $this->localPart, 2)[0];

        return $this;
    }

    public function setDomain(string $domain) : MutableEmail
    {
        $this->domain = $domain;

        return $this;
    }

    public function setLocalPart(string $localPart) : MutableEmail
    {
        $this->localPart = $localPart;

        return $this;
    }

    public function lowerCaseLocalPartIf(bool $condition) : MutableEmail
    {
        if ($condition) {
            $this->localPart = strtolower($this->localPart);
        }

        return $this;
    }
}