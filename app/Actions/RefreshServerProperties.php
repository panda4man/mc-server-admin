<?php

namespace App\Actions;

use App\Models\Server;
use App\Services\ServerMetadataService;

class RefreshServerProperties extends BaseAction
{
    private Server $server;
    private bool $update_model;

    public function __construct(Server $server, bool $update_model = true)
    {
        $this->server = $server;
        $this->update_model = $update_model;
    }

    public function call(): bool
    {
        $dto = ServerMetadataService::fetchProperties($this->server);

        foreach($dto as $key => $value) {
            $this->server->{$key} = $dto->{$key};
        }

        if($this->update_model) {
            $this->server->save();
        }

        return true;
    }
}
