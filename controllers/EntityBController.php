<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/EntityB.php";
require_once __DIR__ . "/../helpers/Validator.php";
require_once __DIR__ . "/../helpers/Debug.php";
require_once __DIR__ . "/../config/StarterPack.php";

class EntityBController extends Controller
{
    private EntityB $model;

    public function __construct()
    {
        $this->model = new EntityB();
    }

    public function index(): void
    {
        $items = $this->model->all();
        $moduleLabel = StarterPackConfig::label("entityB");

        $this->view("entityB/index", [
            "title" => "Data " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
            "items" => $items,
        ]);
    }

    public function create(): void
    {
        $moduleLabel = StarterPackConfig::label("entityB");

        $this->view("entityB/create", [
            "title" => "Tambah " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
        ]);
    }

    public function store(): void
    {
        $moduleLabel = StarterPackConfig::label("entityB");
        $moduleLabelLower = strtolower($moduleLabel);

        $data = [
            "nama" => trim($_POST["nama"] ?? ""),
        ];

        $errors = Validator::required($data, ["nama"]);
        if (!empty($errors)) {
            Debug::dd($errors);
            $this->redirect($this->buildUrl("create", "Nama wajib diisi."));
        }

        $success = $this->model->create($data);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil ditambahkan."
            : "Gagal menambahkan data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    public function edit(int $id = 0): void
    {
        $moduleLabel = StarterPackConfig::label("entityB");
        $item = $this->model->find($id);
        if ($item === null) {
            $this->redirect($this->buildUrl("index", "Data tidak ditemukan."));
        }

        $this->view("entityB/edit", [
            "title" => "Ubah " . $moduleLabel,
            "moduleLabel" => $moduleLabel,
            "item" => $item,
        ]);
    }

    public function update(): void
    {
        $moduleLabel = StarterPackConfig::label("entityB");
        $moduleLabelLower = strtolower($moduleLabel);

        $id = (int) ($_POST["id"] ?? 0);
        $data = [
            "nama" => trim($_POST["nama"] ?? ""),
        ];

        $errors = Validator::required($data, ["nama"]);
        if ($id <= 0 || !empty($errors)) {
            $this->redirect($this->buildUrl("edit", "Data update tidak valid.", $id));
        }

        $success = $this->model->update($id, $data);
        $message = $success
            ? "Data {$moduleLabelLower} berhasil diubah."
            : "Gagal mengubah data {$moduleLabelLower}.";

        $this->redirect($this->buildUrl("index", $message));
    }

    public function delete(int $id = 0): void
    {
        $moduleLabel = StarterPackConfig::label("entityB");
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

    private function buildUrl(string $action, string $message = "", ?int $id = null): string
    {
        $url = BASE_URL . "?controller=entityB&action=" . $action;

        if ($id !== null) {
            $url .= "&id=" . $id;
        }

        if ($message !== "") {
            $url .= "&message=" . urlencode($message);
        }

        return $url;
    }
}
