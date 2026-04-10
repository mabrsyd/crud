# MVC Template SKKNI (PHP Native)

Template ini dibuat untuk kebutuhan ujian/latihan SKKNI Programmer dengan pendekatan:

- PHP Native
- Pola MVC (Model, View, Controller)
- OOP + prepared statement (aman dari SQL injection)
- CRUD + relasi JOIN + dropdown otomatis
- Struktur reusable (mudah di-rename)

## 1. Struktur Project

```text
mvc-template-skkni/
|
|-- config/
|   |-- App.php
|   |-- Database.php
|   `-- StarterPack.php
|
|-- core/
|   |-- Controller.php
|   |-- Model.php
|   `-- Router.php
|
|-- helpers/
|   |-- Validator.php
|   `-- Debug.php
|
|-- models/
|   |-- Entity.php
|   |-- EntityA.php
|   |-- EntityB.php
|   `-- Relation.php
|
|-- controllers/
|   |-- EntityController.php
|   |-- EntityAController.php
|   |-- EntityBController.php
|   `-- RelationController.php
|
|-- views/
|   |-- entity/
|   |-- entityA/
|   |-- entityB/
|   `-- relation/
|
|-- tests/
|   `-- EntityTest.php
|
|-- docs/
|   `-- README.md
|
`-- index.php
```

## 2. Cara Install

1. Copy folder `mvc-template-skkni` ke htdocs (XAMPP) atau folder web server Anda.
2. Buat database baru, contoh: `mvc_template_skkni`.
3. Import file `docs/schema.sql` atau jalankan SQL berikut di MySQL:

```sql
CREATE TABLE entity (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    keterangan TEXT NULL
);

CREATE TABLE entity_a (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

CREATE TABLE entity_b (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

CREATE TABLE relation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entity_a_id INT NOT NULL,
    entity_b_id INT NOT NULL,
    tanggal DATE NOT NULL,
    CONSTRAINT fk_relation_entity_a FOREIGN KEY (entity_a_id) REFERENCES entity_a(id) ON DELETE CASCADE,
    CONSTRAINT fk_relation_entity_b FOREIGN KEY (entity_b_id) REFERENCES entity_b(id) ON DELETE CASCADE
);
```

4. Atur koneksi database di file `config/Database.php` atau lewat environment variable berikut:
   - `DB_HOST`
   - `DB_PORT`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASS`

5. Jalankan aplikasi:
   - Jika pakai Apache: akses sesuai virtual host/localhost.
   - Jika pakai built-in server PHP:

```bash
php -S localhost:8000 -t mvc-template-skkni
```

6. Buka URL:

```text
http://localhost:8000/index.php
```

## 3. Routing Dasar

Router membaca URL query string:

- `?controller=entity&action=index`
- `?controller=entity&action=create`
- `?controller=entityA&action=index`
- `?controller=entityB&action=index`
- `?controller=relation&action=index`

Default route:

- `entity/index`

Jika action tidak ditemukan, router akan melempar error validasi method.

## 4. Penjelasan Relasi (JOIN + Dropdown)

Relasi menggunakan 3 tabel:

- `entity_a (id, nama)`
- `entity_b (id, nama)`
- `relation (id, entity_a_id, entity_b_id, tanggal)`

Implementasi di `models/Relation.php`:

- `allWithJoin()` untuk join 3 tabel dan menampilkan alias `nama_a`, `nama_b`
- `getEntityA()` untuk data dropdown entity A
- `getEntityB()` untuk data dropdown entity B
- `create()` untuk simpan relasi

Di view `views/relation/create.php`, dropdown sudah memiliki opsi default:

```html
<option value="">-- pilih --</option>
```

## 5. Unit Testing Sederhana

File test ada di:

- `tests/EntityTest.php`

Cara jalanin:

```bash
php tests/EntityTest.php
```

Output:

- `TEST BERHASIL`
- `TEST GAGAL`

## 6. Mode Starter Pack (Cukup Ubah 1 File)

Sekarang template sudah punya mode starter pack.
Anda tidak perlu rename banyak file model/controller/view.

File yang cukup diubah:

- `config/StarterPack.php`

Yang bisa disesuaikan dari file itu:

- label menu dan judul halaman
- nama tabel untuk modul entity/entityA/entityB/relation
- nama kolom relasi (`entityAColumn`, `entityBColumn`, `dateColumn`)

Contoh tema ujian: mahasiswa, buku, transaksi

```php
public const MODULES = [
    "entity" => ["label" => "Data Utama", "table" => "data_utama"],
    "entityA" => ["label" => "Mahasiswa", "table" => "mahasiswa"],
    "entityB" => ["label" => "Buku", "table" => "buku"],
    "relation" => ["label" => "Transaksi", "table" => "transaksi"],
];

public const RELATION = [
    "entityAColumn" => "mahasiswa_id",
    "entityBColumn" => "buku_id",
    "dateColumn" => "tanggal",
];
```

Setelah ubah mapping, aplikasi otomatis ikut menyesuaikan label dan query relasi.

## 7. Debugging

Gunakan helper `Debug::dd()` untuk menampilkan isi variabel dan menghentikan proses.

Contoh yang sudah tersedia:

- Debug data index di `EntityController::index`
- Debug validasi input di proses `store/update`
- Debug data dropdown di `RelationController::create`

`Debug::dd()` hanya aktif saat:

- `AppConfig::DEBUG = true`

Jika `DEBUG = false`, `dd()` tidak akan menampilkan output.

## 8. Catatan Standar Kode

Template ini mengikuti ketentuan utama:

- menggunakan `require_once`
- prepared statement untuk query
- pemisahan logic (controller/model) dan tampilan (view)
- penamaan konsisten dan mudah diikuti
- komentar singkat dengan bahasa Indonesia
