<?php

namespace App\Actions;

use App\Models\Server;
use App\Services\MinecraftServerStatusService;

class RefreshServerVersion extends BaseAction
{
    private Server $server;
    private bool $update_model;

    public function __construct(Server $server, bool $update_model = true)
    {
        $this->server       = $server;
        $this->update_model = $update_model;
    }

    public function call(): bool
    {
        $version = MinecraftServerStatusService::version($this->server->box->domain, $this->server->server_port);

        if($version) {
            $this->server->version = $version;
        }

        if($this->update_model) {
            $this->server->save();
        }

        return true;
    }
}
