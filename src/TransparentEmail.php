<?php

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Services\AppsGoogleCom;
use bkrukowski\TransparentEmail\Services\GmailCom;
use bkrukowski\TransparentEmail\Services\OutlookCom;
use bkrukowski\TransparentEmail\Services\ServiceInterface;
use bkrukowski\TransparentEmail\Services\TlenPl;
use bkrukowski\TransparentEmail\Services\Www33MailCom;
use bkrukowski\TransparentEmail\Services\YahooCom;

class TransparentEmail
{
    const SERVICE_GMAIL_COM = GmailCom::class;
    const SERVICE_TLEN_PL = TlenPl::class;
    const SERVICE_WWW_33MAIL_COM = Www33MailCom::class;
    const SERVICE_OUTLOOK_COM = OutlookCom::class;
    const SERVICE_YAHOO_COM = YahooCom::class;
    const SERVICE_APPS_GOOGLE_COM = AppsGoogleCom::class;

    /**
     * Constant ALL_SERVICES can contain different values depends on API version
     */
    const ALL_SERVICES = [
        self::SERVICE_GMAIL_COM,
        self::SERVICE_TLEN_PL,
        self::SERVICE_WWW_33MAIL_COM,
        self::SERVICE_OUTLOOK_COM,
        self::SERVICE_YAHOO_COM,
        self::SERVICE_APPS_GOOGLE_COM,
    ];

    private $services;

    private $caseSensitiveLocalPart;

    public function __construct(array $services = self::ALL_SERVICES, bool $caseSensitiveLocalPart = false)
    {
        $this->services = $services;
        $this->caseSensitiveLocalPart = $caseSensitiveLocalPart;
    }

    /**
     * @param string $email
     * @return string
     * @throws InvalidEmailException
     */
    public function getPrimaryEmail(string $email)
    {
        $this->validateEmailAddress($email);
        if (!$this->caseSensitiveLocalPart) {
            $email = strtolower($email);
        }
        $domain = strtolower(explode('@', $email)[1]);
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