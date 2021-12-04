<?php

namespace App\Services;

use App\Services\Dto\FolderMetadata;
use Illuminate\Support\Collection;

class FolderInfoService
{
    public static function sizeOfDirectory(string $path): ?FolderMetadata
    {
        $output = shell_exec("du -s $path"); //outputs in 512 byte chunks

        $rows = collect(explode("\n", $output))->map(function ($line) {
            return trim($line);
        })->filter(function ($line) {
            return !empty($line);
        })->map(function ($line) {
            $parts = preg_split('/\s+/', $line);

            return new FolderMetadata(intval($parts[0]) * 512, $parts[1]);
        });

        return $rows->first() ?? null;
    }

    public static function sizeOfChildDirectories(string $path): Collection
    {
        if (substr($path, -1) !== '/') {
            $path .= "/";
        }

        $output = shell_exec("du -s $path*/"); //outputs in 512 byte chunks

        return collect(explode("\n", $output))->map(function ($line) {
            return trim($line);
        })->filter(function ($line) {
            return !empty($line);
        })->map(function ($line) {
            $parts = preg_split('/\s+/', $line);

            return new FolderMetadata(intval($parts[0]) * 512, $parts[1]);
        });
    }
}
