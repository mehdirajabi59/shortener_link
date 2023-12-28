<?php

namespace Mehdi\ShortenerLink\Domains\Link\Repository;

use Mehdi\Core\DB\DB;

class UrlRepository implements IUrlRepository
{

    public function all(int $userId): array
    {
        $sth = DB::getConn()->prepare("SELECT *  FROM `url_shortener` WHERE `user_id` = ?");
        $sth->execute([$userId]);
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($shortCode, $userId): bool
    {
        $sth = DB::getConn()->prepare("DELETE FROM `url_shortener` WHERE `user_id` = :user_id AND `short_code` = :short_code");
        $sth->execute([
            ':short_code' => $shortCode,
            ':user_id' =>$userId
        ]);

        return $sth->rowCount() > 0;
    }

    public function create($url, $shortCode, $userId): void
    {
        $sth = DB::getConn()->prepare("INSERT INTO `url_shortener` (`long_url`, `short_code`, `user_id`) VALUES (:url, :short_code, :user_id)");
        $sth->execute([
            ':url' => $url,
            ':short_code' => $shortCode,
            ':user_id' => $userId
        ]);
    }

    public function isShortCodeExists($shortCode): bool
    {
        $sth = DB::getConn()->prepare("SELECT * FROM `url_shortener` WHERE `short_code` = ?");
        $sth->execute([$shortCode]);
        return !! $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function update(): void
    {
        // TODO: Implement update() method.
    }
}