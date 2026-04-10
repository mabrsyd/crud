<?php

define("BASE_PATH", __DIR__);

require_once BASE_PATH . "/config/App.php";
require_once BASE_PATH . "/config/Database.php";
require_once BASE_PATH . "/config/StarterPack.php";
require_once BASE_PATH . "/core/Router.php";

if (AppConfig::DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
} else {
    error_reporting(0);
    ini_set("display_errors", "0");
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// BASE_URL diambil otomatis dari lokasi index.php.
$scriptName = str_replace("\\", "/", $_SERVER["SCRIPT_NAME"] ?? "/index.php");
define("BASE_URL", $scriptName);

// Autoload sederhana untuk class di folder utama MVC.
spl_autoload_register(function (string $className): void {
    $directories = [
        BASE_PATH . "/core/",
        BASE_PATH . "/helpers/",
        BASE_PATH . "/models/",
        BASE_PATH . "/controllers/",
        BASE_PATH . "/config/",
    ];

    foreach ($directories as $directory) {
        $file = $directory . $className . ".php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

try {
    $router = new Router();
    $router->dispatch();
} catch (Throwable $e) {
    if (AppConfig::DEBUG) {
        echo "<h2>Terjadi Kesalahan</h2>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    } else {
        echo "<h2>Terjadi Kesalahan Sistem</h2>";
    }
}
