<?php

namespace bkrukowski\Gordianus\Services;

/**
 * @codeCoverageIgnore
 * @internal
 */
class TlenPL extends MultiDomain
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