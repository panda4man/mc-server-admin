<?php

namespace App\Services\Dto;

class ServerProperties
{
    public string $motd = "";
    public string $gamemode = "";
    public string $level_name = "";
    public string $difficulty = "";
    public ?int $server_port = null;
    public ?bool $hardcore = null;

    public function map(): array
    {
        return [
            'level_name'  => 'level-name',
            'server_port' => 'server-port'
        ];
    }
}
