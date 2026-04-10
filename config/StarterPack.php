<?php

class StarterPackConfig
{
    // Judul aplikasi utama untuk navbar/header.
    public const APP_TITLE = "Template MVC SKKNI";

    // Ubah label dan table sesuai tema soal ujian.
    public const MODULES = [
        "entity" => ["label" => "Entity", "table" => "entity"],
        "entityA" => ["label" => "Entity A", "table" => "entity_a"],
        "entityB" => ["label" => "Entity B", "table" => "entity_b"],
        "relation" => ["label" => "Relation", "table" => "relation"],
    ];

    // Ubah nama kolom relasi jika skema soal berbeda.
    public const RELATION = [
        "entityAColumn" => "entity_a_id",
        "entityBColumn" => "entity_b_id",
        "dateColumn" => "tanggal",
    ];

    public static function label(string $moduleKey): string
    {
        return self::MODULES[$moduleKey]["label"] ?? $moduleKey;
    }

    public static function table(string $moduleKey): string
    {
        return self::MODULES[$moduleKey]["table"] ?? $moduleKey;
    }

    public static function relationColumn(string $columnKey): string
    {
        return self::RELATION[$columnKey] ?? $columnKey;
    }
}
