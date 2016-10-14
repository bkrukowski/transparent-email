<?php

declare(strict_types=1);

namespace bkrukowski\TransparentEmail;

use bkrukowski\TransparentEmail\Services\AppsGoogleCom;
use bkrukowski\TransparentEmail\Services\GmailCom;
use bkrukowski\TransparentEmail\Services\OutlookCom;
use bkrukowski\TransparentEmail\Services\TlenPl;
use bkrukowski\TransparentEmail\Services\Www33MailCom;
use bkrukowski\TransparentEmail\Services\YahooCom;

class TransparentEmailFactory
{
    public static function createDefault() : TransparentEmailInterface
    {
        return new TransparentEmail(self::createServiceCollector());
    }

    private static function createServiceCollector() : ServiceCollectorInterface
    {
        $collector = new ServiceCollector();

        foreach (self::getAllServicesClasses() as $servicesClass) {
            $collector->addService(new $servicesClass());
        }

        return $collector;
    }

    private static function getAllServicesClasses() : array
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