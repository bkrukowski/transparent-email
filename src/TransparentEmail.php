<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Emails\EmailInterface;
use bkrukowski\TransparentEmail\Services\ServiceInterface;

class TransparentEmail implements TransparentEmailInterface
{
    /**
     * @var ServiceCollectorInterface|ServiceInterface[]
     */
    private $services;

    public function __construct(ServiceCollectorInterface $services)
    {
        $this->services = $services;
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