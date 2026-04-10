<?php

class Controller
{
    protected function view(string $path, array $data = []): void
    {
        $viewFile = BASE_PATH . "/views/" . $path . ".php";

        if (!file_exists($viewFile)) {
            throw new RuntimeException("View tidak ditemukan: " . $path);
        }

        extract($data, EXTR_SKIP);
        require_once $viewFile;
    }

    protected function redirect(string $url): void
    {
        header("Location: " . $url);
        exit;
    }
}
