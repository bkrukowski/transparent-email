<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail\Services;

use bkrukowski\TransparentEmail\Emails\EditableEmail;
use bkrukowski\TransparentEmail\Emails\EmailInterface;

class YandexRu implements ServiceInterface
{
    public function getPrimaryEmail(EmailInterface $email) : EmailInterface
    {
        return (new EditableEmail($email))
            ->removeSuffixAlias('+')
            ->lowerCaseLocalPartIf(true)
            ->setDomain($this->mapDomain($email->getDomain()));
    }

    public function isSupported(EmailInterface $email) : bool
    {
        return in_array($email->getDomain(), ['ya.ru', 'yandex.ru']);
    }

    protected function getDomainMapping() : array
    {
        return [
            'ya.ru' => 'yandex.ru',
        ];
    }

    private function mapDomain(string $domain) : string
    {
        return $this->getDomainMapping()[$domain] ?? $domain;
    }
}