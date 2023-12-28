<?php

namespace Mehdi\ShortenerLink\Domains\Link\Repository;

use Mehdi\Core\DB\DB;
use Mehdi\ShortenerLink\Entity\UrlShortener;
use PDO;

class UrlShortenerRepository implements IUrlShortenerRepository
{
    const TABLE_NAME = 'url_shortener';
    public function show(string $shortCode): UrlShortener
    {
        $tableName = static::TABLE_NAME;
        $sth =DB::getConn()->prepare("SELECT * FROM `{$tableName}` WHERE `short_code` = ?");
        $sth->execute([$shortCode]);

        $link = $sth->fetch(PDO::FETCH_ASSOC);

        $entity = new UrlShortener();

        if ($link) {
            $entity->setAttributes($link);
        }

        return $entity;
    }
}