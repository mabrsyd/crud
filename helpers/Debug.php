<?php

require_once __DIR__ . "/../config/App.php";

class Debug
{
    public static function dd($data): void
    {
        if (!AppConfig::DEBUG) {
            return;
        }

        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die;
    }
}
