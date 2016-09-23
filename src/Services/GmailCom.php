<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

/**
 * @internal
 */
class GmailCom implements ServiceInterface
{
    public function getPrimaryEmail(string $email) : string
    {
        list($name, $domain) = explode('@', strtolower($email));

        return explode('+', str_replace('.', '', $name))[0] . '@' . $this->mapDomain($domain);
    }

    public function isDomainSupported(string $domain) : bool
    {
        return in_array(strtolower($domain), ['gmail.com', 'googlemail.com']);
    }

    private function mapDomain(string $domain) : string
    {
        $mapping = [
            'googlemail.com' => 'gmail.com',
        ];
        return $mapping[$domain] ?? $domain;
    }
}