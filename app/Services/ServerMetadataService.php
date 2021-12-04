<?php

namespace App\Services;

use App\Models\Server;
use App\Services\Dto\ServerProperties;

class ServerMetadataService
{
    private static string $property_file = 'server.properties';

    public static function fetchProperties(Server $server): ServerProperties
    {
        $path = "{$server->root}/" . static::$property_file;

        if (!file_exists($path)) {
            throw new \Exception($path . " does not exist. Please make sure a server properties file exists for this server.");
        }

        $contents = file_get_contents($path);
        $lines    = collect(explode(PHP_EOL, $contents))->mapWithKeys(function ($line) {
            $parts = explode("=", trim($line), 2);

            return [
                $parts[0] => $parts[1]
            ];
        });
        $dto      = new ServerProperties();

        foreach ($dto as $key => $value) {
            $original_key = $key;

            if (array_key_exists($key, $dto->map())) {
                $key = $dto->map()[$key];
            }

            if ($lines->has($key)) {
                $dto->{$original_key} = $lines->get($key);
            }
        }

        return $dto;
    }
}
