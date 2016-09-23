<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

/**
 * @codeCoverageIgnore
 * @internal
 */
class TlenPl extends MultiDomain
{
    protected function getDomainList() : array
    {
        return [
            'o2.pl',
            'tlen.pl',
            'go2.pl',
            'prokonto.pl',
        ];
    }

    protected function getPrimaryDomain() : string
    {
        return 'o2.pl';
    }
}