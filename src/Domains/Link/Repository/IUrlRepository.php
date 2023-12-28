<?php

namespace Mehdi\ShortenerLink\Domains\Link\Repository;

interface IUrlRepository
{
    public function all(int $userId): array;

    public function delete($shortCode, $userId): bool;

    public function create($url, $shortCode, $userId): void;

    public function update(): void;

    public function isShortCodeExists($shortCode): bool;
}