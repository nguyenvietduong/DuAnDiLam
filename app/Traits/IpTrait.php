<?php

namespace App\Traits;

trait IpTrait
{
    public function getClientIp()
    {
        $ips = [
            getenv('HTTP_CLIENT_IP'),
            getenv('HTTP_X_FORWARDED_FOR'),
            getenv('HTTP_X_FORWARDED'),
            getenv('HTTP_FORWARDED_FOR'),
            getenv('HTTP_FORWARDED'),
            getenv('REMOTE_ADDR'),
        ];
        foreach ($ips as $ip) {
            if ($ip) {
                $arrayIPs = explode(",", $ip);
                return reset($arrayIPs);
            }
        }
        return config('settings.nullIpAddress');
    }
}
