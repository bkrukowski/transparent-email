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
            $this->localPart = mb_strtolower($this->localPart);
        }
        $this->domain = mb_strtolower($this->domain);
    }

    private function validateEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE))) {
            throw new InvalidEmailException("Email '{$email}' is not valid!");
        }
    }
}