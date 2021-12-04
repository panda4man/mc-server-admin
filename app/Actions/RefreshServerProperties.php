<?php

namespace App\Actions;

use App\Models\Server;
use App\Services\ServerMetadataService;

class RefreshServerProperties extends BaseAction
{
    private Server $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function call(): bool
    {
        $dto = ServerMetadataService::fetchProperties($this->server);

        foreach($dto as $key => $value) {
            $this->server->{$key} = $dto->{$key};
        }

        $this->server->save();

        return true;
    }
}
