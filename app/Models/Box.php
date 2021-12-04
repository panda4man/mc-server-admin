<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'root', 'server_roots', 'used_space'];

    protected $casts = [
        'server_roots' => 'array'
    ];
}
