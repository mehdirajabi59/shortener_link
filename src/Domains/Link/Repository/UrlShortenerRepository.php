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

        $conn = DB::getConn();

        $conn->beginTransaction();

        try {
            $sth = $conn->prepare("SELECT * FROM `{$tableName}` WHERE `short_code` = ?");
            $sth->execute([$shortCode]);

            $this->increaseUsage($shortCode);

        }catch (\Exception){
            $conn->rollBack();
        }


        $link = $sth->fetch(PDO::FETCH_ASSOC);

        $entity = new UrlShortener();
        $entity->setAttributes($link);

        return $entity;
    }

    public function increaseUsage(string $shortCode)
    {
        $tableName = static::TABLE_NAME;
        $sth = DB::getConn()->prepare("UPDATE {$tableName} SET `usage` = `usage` + 1 WHERE `short_code` = ?");
        $sth->execute([$shortCode]);
    }
}