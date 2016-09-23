<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Services\AppsGoogleCom;
use bkrukowski\TransparentEmail\Services\GmailCom;
use bkrukowski\TransparentEmail\Services\OutlookCom;
use bkrukowski\TransparentEmail\Services\TlenPl;
use bkrukowski\TransparentEmail\Services\Www33MailCom;
use bkrukowski\TransparentEmail\Services\YahooCom;

class DefaultServiceCollector extends ServiceCollector
{
    public function __construct()
    {
        foreach ($this->getAllServicesClasses() as $class) {
            $this->addService(new $class());
        }
    }

    private function getAllServicesClasses() : array
    {
        return [
            GmailCom::class,
            OutlookCom::class,
            YahooCom::class,
            Www33MailCom::class,
            TlenPl::class,
            AppsGoogleCom::class,
        ];
    }
}