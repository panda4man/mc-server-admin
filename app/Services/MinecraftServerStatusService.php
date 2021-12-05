<?php

namespace App\Services;

use Http;

class MinecraftServerStatusService
{
    private static string $base_url = 'https://api.mcsrvstat.us/2/';

    public static function version(string $domain_ip, int $port)
    {
        $url = sprintf("%s%s:%d", static::$base_url, $domain_ip, $port);
        $res = Http::get($url);

        if ($res->successful()) {
            return $res->json('version');
        }

        return null;
    }
}
