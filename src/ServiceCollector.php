<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Services\ServiceInterface;

class ServiceCollector implements ServiceCollectorInterface
{
    private $services = [];

    public function addService(ServiceInterface $service)
    {
        $this->services[] = $service;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        foreach ($this->services as $service) {
            yield $service;
        }
    }
}