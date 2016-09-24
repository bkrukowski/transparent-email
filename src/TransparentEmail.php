<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Emails\EmailInterface;
use bkrukowski\TransparentEmail\Services\ServiceInterface;

class TransparentEmail
{
    /**
     * @var ServiceCollectorInterface|ServiceInterface[]
     */
    private $services;

    public function __construct(ServiceCollectorInterface $services = null)
    {
        $this->services = $services ?: new DefaultServiceCollector();
    }

    public function getPrimaryEmail(EmailInterface $email) : EmailInterface
    {
        foreach ($this->services as $service) {
            if ($service->isSupported($email)) {
                return $service->getPrimaryEmail($email);
            }
        }

        return $email;
    }
}