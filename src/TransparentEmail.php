<?php

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Services\ServiceInterface;

class TransparentEmail
{
    /**
     * @var ServiceCollectorInterface|ServiceInterface[]
     */
    private $services;

    /**
     * @var bool
     */
    private $caseSensitiveLocalPart;

    public function __construct(ServiceCollectorInterface $services = null, bool $caseSensitiveLocalPart = false)
    {
        $this->services = $services ?: new DefaultServiceCollector();
        $this->caseSensitiveLocalPart = $caseSensitiveLocalPart;
    }

    /**
     * @param string $email
     * @return string
     * @throws InvalidEmailException
     */
    public function getPrimaryEmail(string $email)
    {
        $this->validateEmailAddress($email);
        if (!$this->caseSensitiveLocalPart) {
            $email = strtolower($email);
        }
        $domain = strtolower(explode('@', $email)[1]);
        $result = $email;

        foreach ($this->services as $service) {
            if ($service->isDomainSupported($domain)) {
                $result = $service->getPrimaryEmail($result);
            }
        }

        return $result;
    }

    /**
     * @param string $email
     * @throws InvalidEmailException
     */
    private function validateEmailAddress(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidEmailException("Invalid email '{$email}'!");
        }
    }
}