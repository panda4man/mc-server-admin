<?php

namespace App\Actions;

use App\Models\Server;
use Carbon\Carbon;

class RefreshServerTimestamp extends BaseAction
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
        $path_to_logs = $this->server->root . "/logs";

        if (!file_exists($path_to_logs)) {
            throw new \Exception("Logs path does not exist at: $path_to_logs");
        }

        $unix_stamp = filectime($path_to_logs);
        $timestamp  = Carbon::createFromTimestamp($unix_stamp);

        $this->server->last_played_at = $timestamp;

        if($this->update_model) {
            $this->server->save();
        }

        return true;
    }
}
