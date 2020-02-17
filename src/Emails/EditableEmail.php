<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Emails;

/**
 * @internal
 */
class EditableEmail implements EmailInterface
{
    use EmailTrait;

    public function __construct(EmailInterface $email)
    {
        $this->localPart = $email->getLocalPart();
        $this->domain = $email->getDomain();
    }

    public function removeFromLocalPart(string $toRemove) : EditableEmail
    {
        $copy = clone $this;
        $copy->localPart = str_replace($toRemove, '', $this->localPart);

        return $copy;
    }

    public function replaceInLocalPart(string $toReplace, string $replacement) : EditableEmail
    {
        $copy = clone $this;
        $copy->localPart = str_replace($toReplace, $replacement, $this->localPart);

        return $copy;
    }

    public function removeSuffixAlias(string $delimiter) : EditableEmail
    {
        $copy = clone $this;
        $copy->localPart = explode($delimiter, $this->localPart, 2)[0];

        return $copy;
    }

    public function setDomain(string $domain) : EditableEmail
    {
        $copy = clone $this;
        $copy->domain = $domain;

        return $copy;
    }

    public function setLocalPart(string $localPart) : EditableEmail
    {
        $copy = clone $this;
        $copy->localPart = $localPart;

        return $copy;
    }

    public function lowerCaseLocalPartIf(bool $condition) : EditableEmail
    {
        if ($condition) {
            $copy = clone $this;
            $copy->localPart = strtolower($this->localPart);

            return $copy;
        }

        return $this;
    }
}