<?php

require_once __DIR__ . "/../config/App.php";

// Router sederhana berbasis query string controller/action.
class Router
{
    // Menentukan controller dan action lalu menjalankan method yang sesuai.
    public function dispatch(): void
    {
        $controllerParam = $_GET["controller"] ?? AppConfig::DEFAULT_CONTROLLER;
        $action = $_GET["action"] ?? AppConfig::DEFAULT_ACTION;

        $controllerParam = $this->sanitizeSegment($controllerParam);
        $action = $this->sanitizeSegment($action);

        if ($controllerParam === "") {
            $controllerParam = AppConfig::DEFAULT_CONTROLLER;
        }

        if ($action === "") {
            $action = AppConfig::DEFAULT_ACTION;
        }

        $controllerClass = ucfirst($controllerParam) . "Controller";

        if (!class_exists($controllerClass)) {
            $controllerClass = ucfirst(AppConfig::DEFAULT_CONTROLLER) . "Controller";
            $action = AppConfig::DEFAULT_ACTION;
        }

        $controllerObject = new $controllerClass();

        if (!method_exists($controllerObject, $action)) {
            throw new RuntimeException("Action tidak tersedia: " . $action);
        }

        $id = $_GET["id"] ?? null;
        if ($id !== null && $id !== "") {
            $controllerObject->{$action}((int) $id);
            return;
        }

        $controllerObject->{$action}();
    }

    // Membersihkan input URL agar hanya karakter aman yang diproses.
    private function sanitizeSegment(string $segment): string
    {
        return preg_replace("/[^a-zA-Z0-9_]/", "", $segment) ?? "";
    }
}
