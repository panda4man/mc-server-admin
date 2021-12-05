<?php

namespace App\Services;

use App\Actions\RefreshServerFolderSize;
use App\Actions\RefreshServerProperties;
use App\Actions\RefreshServerTimestamp;
use App\Actions\RefreshServerVersion;
use App\Models\Box;
use App\Models\Server;
use Illuminate\Support\Collection;

class BoxServerRootAnalyzer
{
    private static string $property_file = 'server.properties';

    public static function findValidServers(string $path): Collection
    {
        if (substr($path, -1) !== '/') {
            $path .= "/*";
        } else {
            $path .= "*";
        }

        return collect(glob($path, GLOB_ONLYDIR))->filter(function ($path) {
            if (substr($path, -1) !== '/') {
                $path .= "/";
            }

            $path .= static::$property_file;

            return file_exists($path);
        })->values();
    }

    public static function initializeServers(Box $box, Collection $paths): void
    {
        $paths->each(function ($path) use ($box) {
            $server = $box->servers()->where("root", $path)->first();

            if (!$server) {
                $server = Server::make([
                    'root' => $path
                ])->box()->associate($box);
            }

            RefreshServerProperties::make($server, false)->call();
            RefreshServerFolderSize::make($server, false)->call();
            RefreshServerTimestamp::make($server, false)->call();
            RefreshServerVersion::make($server, false)->call();

            $server->save();
        });
    }
}
