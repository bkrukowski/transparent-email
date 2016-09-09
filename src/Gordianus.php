<?php

namespace bkrukowski\Gordianus;

use bkrukowski\Gordianus\Services\GmailCOM;
use bkrukowski\Gordianus\Services\ServiceInterface;
use bkrukowski\Gordianus\Services\TlenPL;
use bkrukowski\Gordianus\Services\WWW33MailCOM;

class Gordianus
{
    const SERVICE_GMAIL_COM = GmailCOM::class;
    const SERVICE_TLEN_PL = TlenPL::class;
    const SERVICE_WWW_33MAIL_COM = WWW33MailCOM::class;

    /**
     * Constant ALL_SERVICES can contain different values depends on API version
     */
    const ALL_SERVICES = [
        self::SERVICE_GMAIL_COM,
        self::SERVICE_TLEN_PL,
        self::SERVICE_WWW_33MAIL_COM,
    ];

    private $services;

    public function __construct(array $services = self::ALL_SERVICES)
    {
        $this->services = $services;
    }

    /**
     * @param string $email
     * @return string
     * @throws InvalidEmailException
     */
    public function getPrimaryEmail(string $email)
    {
        $this->validateEmailAddress($email);
        $email = strtolower($email);
        list(, $domain) = explode('@', $email);
        $result = $email;

        foreach ($this->services as $serviceClass) {
            /** @var ServiceInterface $service */
            $service = new $serviceClass();
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