<?php
namespace Mehdi\Core\Helpers;
class Config
{
    static array $configs = [];

    public static function get($key)
    {
        static::loadConfig();

        $keys = explode('.', $key);

        $value = static::$configs[array_shift($keys)];

        array_map(function ($key) use(&$value){
            if (is_array($value) && array_key_exists($key, $value)){
                $value = $value[$key];
            }
        }, $keys);

        return $value;
    }

    private static function loadConfig(): void
    {
        if (! count(static::$configs)) {
            static::$configs = require __DIR__ .'/../../config.php';
        }
    }
}

