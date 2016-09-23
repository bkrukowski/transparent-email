<?php

declare(strict_types=1);

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
    private $caseSensitive;

    public function __construct(ServiceCollectorInterface $services = null, bool $caseSensitive = false)
    {
        $this->services = $services ?: new DefaultServiceCollector();
        $this->caseSensitive = $caseSensitive;
    }

    /**
     * @param string $email
     * @return string
     * @throws InvalidEmailException
     */
    public function getPrimaryEmail(string $email)
    {
        $this->validateEmailAddress($email);
        if (!$this->caseSensitive) {
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