<?php

namespace App\Services\Dto;

class FolderMetadata
{
    public int $size;
    public string $path;

    public function __construct(int $size, string $path)
    {
        $this->size = $size;
        $this->path = $path;
    }

    public function sizeInKb(): int
    {
        return intval(ceil($this->size / 1024));
    }

    public function sizeInMb(): int
    {
        return intval(ceil($this->size / 1024 / 1024));
    }

    public function sizeInGb(): int
    {
        return intval(ceil($this->size / 1024 / 1024 / 1024));
    }
}
