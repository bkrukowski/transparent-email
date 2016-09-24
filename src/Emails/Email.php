<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Emails;

class Email implements EmailInterface
{
    use EmailTrait;

    public function __construct(string $email, bool $caseSensitive = false)
    {
        $this->validateEmail($email);
        list($this->localPart, $this->domain) = explode('@', $email);
        if (!$caseSensitive) {
            $this->localPart = strtolower($this->localPart);
        }
        $this->domain = strtolower($this->domain);
    }

    private function validateEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("Email '{$email}' is not valid!");
        }
    }
}