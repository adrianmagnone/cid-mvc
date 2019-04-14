<?php
namespace Cid;

use Dotenv\Dotenv;

class Config
{
    public static function init()
    {
        $dotenv = new Dotenv(ROOT);
        $dotenv->load();
        $dotenv->required(['DB_DSN', 'DB_USERNAME', 'DB_PASSWORD']);
    }

    public static function get($value)
    {
        //var_dump($value);

        //var_dump($_ENV);
        return getenv($value);
    }

    public static function __callStatic($name, $arguments)
    {
        $env = preg_replace('/\B([A-Z])/', '_$1', $name);

        return getenv( strtoupper($env) );
    }
}