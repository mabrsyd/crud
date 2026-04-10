<?php

require_once __DIR__ . "/../config/App.php";
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../models/Entity.php";

try {
    $entityModel = new Entity();

    $namaTest = "Entity Test " . date("YmdHis");
    $keteranganTest = "Data uji otomatis";

    $created = $entityModel->create([
        "nama" => $namaTest,
        "keterangan" => $keteranganTest,
    ]);

    if (!$created) {
        echo "TEST GAGAL";
        exit;
    }

    $allData = $entityModel->all();
    $found = false;

    foreach ($allData as $row) {
        if (($row["nama"] ?? "") === $namaTest) {
            $found = true;
            break;
        }
    }

    echo $found ? "TEST BERHASIL" : "TEST GAGAL";
} catch (Throwable $e) {
    echo "TEST GAGAL";
}
