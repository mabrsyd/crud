<?php

// Helper validasi input sederhana untuk field wajib isi.
class Validator
{
    // Mengecek field yang wajib diisi, lalu mengembalikan daftar error.
    public static function required(array $data, array $fields): array
    {
        $errors = [];

        foreach ($fields as $field) {
            $value = $data[$field] ?? null;

            if ($value === null || trim((string) $value) === "") {
                $errors[$field] = "Field {$field} wajib diisi.";
            }
        }

        return $errors;
    }
}
