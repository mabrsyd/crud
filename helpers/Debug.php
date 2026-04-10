<?php

require_once __DIR__ . "/../config/App.php";

// Helper debugging untuk melihat isi variabel saat pengembangan.
class Debug
{
    // Dump variabel lalu hentikan proses jika mode DEBUG aktif.
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
