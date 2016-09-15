<?php

namespace bkrukowski\TransparentEmail\Services;

/**
 * @internal
 */
class AppsGoogleCom extends GmailCom
{
    public function isDomainSupported(string $domain) : bool
    {
        getmxrr($domain, $mxhosts);
        $regex1 = '#\\.googlemail\\.com$#';
        $regex2 = '#\\.google\\.com$#';
        foreach ($mxhosts as $host) {
            if (preg_match($regex1, $host) || preg_match($regex2, $host)) {
                return true;
            }
        }

        return false;
    }
}