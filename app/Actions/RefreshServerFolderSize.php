<?php

namespace App\Actions;

use App\Models\Server;
use App\Services\FolderInfoService;

class RefreshServerFolderSize extends BaseAction
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
        $dto                = FolderInfoService::sizeOfDirectory($this->server->root);
        $this->server->size = $dto->size;

        if ($this->update_model) {
            $this->server->save();
        }

        return true;
    }
}
