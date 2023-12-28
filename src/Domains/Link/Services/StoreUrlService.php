<?php

namespace Mehdi\ShortenerLink\Domains\Link\Services;

use Mehdi\ShortenerLink\Domains\Link\Repository\IUrlRepository;

class StoreUrlService
{

    public function __construct(private IUrlRepository $urlRepository)
    {
    }

    public function create($url, $userId): void
    {
        do{
            $bytes = random_bytes(5);
            $shortCode = bin2hex($bytes);
        }while($this->urlRepository->isShortCodeExists($shortCode));

        $this->urlRepository->create($url, $shortCode, $userId);
    }

    public function delete($shortCode, $userId): bool
    {
        return $this->urlRepository->delete($shortCode, $userId);
    }

    public function all($userId)
    {
        return $this->urlRepository->all($userId);
    }
}