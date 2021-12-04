<?php

namespace App\Actions;

use App\Models\Server;
use App\Services\FolderInfoService;

class RefreshServerFolderSize extends BaseAction
{
    private Server $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function call(): bool
    {
        $dto                = FolderInfoService::sizeOfDirectory($this->server->root);
        $this->server->size = $dto->size;
        $this->server->save();

        return true;
    }
}
