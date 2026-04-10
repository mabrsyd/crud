<?php require_once __DIR__ . "/../partials/header.php"; ?>

<!-- Halaman form tambah data entity. -->

<?php $moduleLabel = $moduleLabel ?? "Entity"; ?>

<section class="card">
    <h2><?= htmlspecialchars($title ?? ("Tambah " . $moduleLabel)); ?></h2>

    <form method="POST" action="<?= BASE_URL; ?>?controller=entity&action=store">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Contoh: Produk A" required>

        <label for="keterangan">Keterangan</label>
        <textarea id="keterangan" name="keterangan" rows="4" placeholder="Keterangan tambahan"></textarea>

        <div class="actions">
            <button class="btn" type="submit">Simpan</button>
            <a class="btn btn-secondary" href="<?= BASE_URL; ?>?controller=entity&action=index">Kembali</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
