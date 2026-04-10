<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/Entity.php";
require_once __DIR__ . "/../helpers/Validator.php";
require_once __DIR__ . "/../helpers/Debug.php";
require_once __DIR__ . "/../config/StarterPack.php";

// Controller modul utama untuk proses CRUD entity.
class EntityController extends Controller
{
    private Entity $model;

    public function __construct()
    {
        $this->model = new Entity();
    }

    // Menampilkan daftar data entity.
    public function index(): void
    {
        $items = $this->model->all();
        $moduleLabel = StarterPackConfig::label("entity");

        // Contoh debugging data index.
        if (isset($_GET["debug"]) && $_GET["debug"] === "1") {
            Debug::dd($items);
        }

        $this->view("entity/index", [
            "title" => "Data " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
            "items" => $items,
        ]);
    }

    // Menampilkan form tambah data entity.
    public function create(): void
    {
        $moduleLabel = StarterPackConfig::label("entity");

        $this->view("entity/create", [
            "title" => "Tambah " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
        ]);
    }

    // Memproses simpan data baru dari form create.
    public function store(): void
    {
        $moduleLabel = StarterPackConfig::label("entity");
        $moduleLabelLower = strtolower($moduleLabel);

        $data = [
            "nama" => trim($_POST["nama"] ?? ""),
            "keterangan" => trim($_POST["keterangan"] ?? ""),
        ];

        $errors = Validator::required($data, ["nama"]);
        if (!empty($errors)) {
            // Contoh debugging validasi input.
            Debug::dd($errors);
            $this->redirect($this->buildUrl("create", "Data belum lengkap."));
        }

        $success = $this->model->create($data);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil ditambahkan."
            : "Gagal menambahkan data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    // Menampilkan form edit berdasarkan ID data.
    public function edit(int $id = 0): void
    {
        $moduleLabel = StarterPackConfig::label("entity");
        $item = $this->model->find($id);
        if ($item === null) {
            $this->redirect($this->buildUrl("index", "Data tidak ditemukan."));
        }

        $this->view("entity/edit", [
            "title" => "Ubah " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
            "item" => $item,
        ]);
    }

    // Memproses update data entity.
    public function update(): void
    {
        $moduleLabel = StarterPackConfig::label("entity");
        $moduleLabelLower = strtolower($moduleLabel);

        $id = (int) ($_POST["id"] ?? 0);
        $data = [
            "nama" => trim($_POST["nama"] ?? ""),
            "keterangan" => trim($_POST["keterangan"] ?? ""),
        ];

        $errors = Validator::required($data, ["nama"]);
        if ($id <= 0 || !empty($errors)) {
            Debug::dd(["id" => $id, "errors" => $errors]);
            $this->redirect($this->buildUrl("edit", "Data update tidak valid.", $id));
        }

        $success = $this->model->update($id, $data);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil diubah."
            : "Gagal mengubah data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    // Menghapus data entity berdasarkan ID.
    public function delete(int $id = 0): void
    {
        $moduleLabel = StarterPackConfig::label("entity");
        $moduleLabelLower = strtolower($moduleLabel);

        if ($id <= 0) {
            $this->redirect($this->buildUrl("index", "ID tidak valid."));
        }

        $success = $this->model->delete($id);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil dihapus."
            : "Gagal menghapus data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    // Membuat URL redirect agar query controller/action tetap konsisten.
    private function buildUrl(string $action, string $message = "", ?int $id = null): string
    {
        $url = BASE_URL . "?controller=entity&action=" . $action;

        if ($id !== null) {
            $url .= "&id=" . $id;
        }

        if ($message !== "") {
            $url .= "&message=" . urlencode($message);
        }

        return $url;
    }
}
