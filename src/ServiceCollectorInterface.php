<?php

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Services\ServiceInterface;

interface ServiceCollectorInterface extends \IteratorAggregate
{
    /**
     * @return ServiceInterface[]
     */
    public function getIterator();
}