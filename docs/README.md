# MVC Template SKKNI (PHP Native)

Dokumen ini menjelaskan fungsi arsitektur project secara lengkap supaya mudah dipakai saat ujian dan mudah diulang saat latihan mandiri.

## 1. Tujuan Template

Template ini dibuat untuk:

1. Menyediakan kerangka MVC Native PHP yang ringkas.
2. Mempercepat pembuatan CRUD dasar.
3. Menangani relasi JOIN + dropdown otomatis.
4. Menjadi starter reusable untuk tema soal apa pun.

## 2. Struktur Project

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
|   |-- partials/
|   |-- entity/
|   |-- entityA/
|   |-- entityB/
|   `-- relation/
|
|-- tests/
|   `-- EntityTest.php
|
|-- docs/
|   |-- README.md
|   `-- schema.sql
|
`-- index.php
```

## 3. Arsitektur dan Fungsi Tiap Komponen

### 3.1 Config

1. App.php
    - Mengatur mode DEBUG.
    - Menentukan default controller dan action.

2. Database.php
    - Membuat koneksi PDO sekali pakai (singleton sederhana).
    - Menetapkan mode error PDO::ERRMODE_EXCEPTION.
    - Menyediakan konfigurasi via environment variable.

3. StarterPack.php
    - Mengatur label tampilan per modul.
    - Mengatur nama tabel per modul.
    - Mengatur nama kolom relasi agar query fleksibel.

### 3.2 Core

1. Controller.php
    - Method view(path, data): render file view.
    - Method redirect(url): redirect halaman.

2. Model.php
    - Menyimpan koneksi DB di property conn.
    - Menyediakan operasi all(), find(id), delete(id).
    - Menjadi parent class semua model.

3. Router.php
    - Membaca query string controller dan action.
    - Menjalankan controller/action valid.
    - Menjaga default route saat parameter kosong.

### 3.3 Helpers

1. Validator.php
    - required(data, fields): cek field wajib isi.
    - Mengembalikan array error per field.

2. Debug.php
    - dd(data): dump variabel dan stop proses.
    - Hanya aktif saat AppConfig::DEBUG = true.

### 3.4 Models

1. Entity.php
    - Model utama dengan field nama + keterangan.

2. EntityA.php
    - Model master A.

3. EntityB.php
    - Model master B.

4. Relation.php
    - allWithJoin(): membaca data gabungan dari 3 tabel.
    - getEntityA(), getEntityB(): sumber dropdown relasi.
    - create(): menyimpan data relasi.

### 3.5 Controllers

1. EntityController.php
    - CRUD untuk modul utama.

2. EntityAController.php
    - CRUD untuk master A.

3. EntityBController.php
    - CRUD untuk master B.

4. RelationController.php
    - Menampilkan JOIN relasi.
    - Menampilkan form dropdown relasi.
    - Menyimpan dan menghapus relasi.

### 3.6 Views

1. views/partials/header.php
    - Layout bagian atas (menu, judul, style).

2. views/partials/footer.php
    - Layout bagian bawah.

3. views/entity, views/entityA, views/entityB
    - index.php: tabel daftar data.
    - create.php: form tambah data.
    - edit.php: form ubah data.

4. views/relation
    - index.php: daftar data JOIN.
    - create.php: form relasi dengan dropdown.

### 3.7 Tests

1. tests/EntityTest.php
    - Uji sederhana method create() pada model Entity.
    - Output: TEST BERHASIL / TEST GAGAL.

## 4. Alur Request (Request Flow)

1. User akses index.php.
2. index.php load config, register autoload, lalu jalankan Router.
3. Router memilih controller/action dari URL.
4. Controller memanggil model untuk ambil/simpan data.
5. Controller me-render view dengan data.
6. View menampilkan hasil ke browser.

## 5. Cara Install dan Menjalankan

1. Copy folder project ke web root.
2. Buat database bernama mvc_template_skkni.
3. Import docs/schema.sql.
4. Atur koneksi di config/Database.php.
5. Jalankan server:

```bash
php -S localhost:8000 -t mvc-template-skkni
```

6. Buka:

```text
http://localhost:8000/index.php
```

## 6. Routing yang Tersedia

1. ?controller=entity&action=index
2. ?controller=entityA&action=index
3. ?controller=entityB&action=index
4. ?controller=relation&action=index

Default route:

1. entity/index

## 7. Penjelasan Debug dan Validator

### Validator

Validator::required() dipakai sebelum proses simpan/update untuk memastikan data inti tidak kosong.

### Debug

Debug::dd() dipakai saat inspeksi data:

1. Debug daftar data.
2. Debug hasil validasi.
3. Debug hasil dropdown relasi.

Catatan:

1. Jika DEBUG true, dd akan tampil dan menghentikan proses.
2. Jika DEBUG false, dd tidak menampilkan apa pun.

## 8. Mode Starter Pack (Ubah 1 File)

File yang diubah hanya:

1. config/StarterPack.php

Yang bisa diganti dari file ini:

1. Judul aplikasi.
2. Label menu modul.
3. Nama tabel modul.
4. Nama kolom relasi.

## 9. SQL Relasi Dasar

Tabel relasi menggunakan struktur:

1. entity_a (id, nama)
2. entity_b (id, nama)
3. relation (id, entity_a_id, entity_b_id, tanggal)

Dropdown pada form relasi sudah memiliki opsi default:

```html
<option value="">-- pilih --</option>
```

## 10. Cara Menjalankan Unit Test

```bash
php tests/EntityTest.php
```

Hasil test:

1. TEST BERHASIL
2. TEST GAGAL

## 11. Checklist Latihan Ulang Mandiri

1. Jalankan project dari nol.
2. Input data di EntityA dan EntityB.
3. Buat relasi dari menu Relation.
4. Pastikan halaman JOIN menampilkan nama, bukan ID.
5. Ulang dengan mengganti mapping di StarterPack.

## 12. Standar Kode yang Dipakai

1. require_once untuk load file.
2. Prepared statement untuk query.
3. Logic dipisah antara model-controller-view.
4. Penamaan file dan class konsisten.
5. Komentar penting ditambahkan di file inti untuk memudahkan belajar.
