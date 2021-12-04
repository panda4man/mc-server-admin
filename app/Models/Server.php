<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'root', 'size', 'motd', 'gamemode', 'level_name', 'difficulty', 'server_port', 'hardcore'];

    protected $casts = [
        'hardcore' => 'boolean'
    ];

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }
}
