<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'root', 'size', 'motd', 'gamemode', 'level_name', 'difficulty', 'server_port', 'hardcore', 'last_played_at'];

    protected $casts = [
        'hardcore'       => 'boolean',
        'last_played_at' => 'datetime',
    ];

    public function setRootAttribute($value)
    {
        if (substr($value, -1) === '/') {
            $value = substr($value, 0, -1);
        }

        $this->attributes['root'] = $value;
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }
}
