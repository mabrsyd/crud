<?php require_once __DIR__ . "/../partials/header.php"; ?>

<!-- Halaman daftar data entity. -->

<?php $moduleLabel = $moduleLabel ?? "Entity"; ?>
<?php $moduleLabelLower = strtolower($moduleLabel); ?>

<section class="card">
    <div class="card-head">
        <h2><?= htmlspecialchars($title ?? ("Data " . $moduleLabel)); ?></h2>
        <a class="btn" href="<?= BASE_URL; ?>?controller=entity&action=create">Tambah <?= htmlspecialchars($moduleLabel); ?></a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= (int) $item["id"]; ?></td>
                        <td><?= htmlspecialchars($item["nama"]); ?></td>
                        <td><?= htmlspecialchars($item["keterangan"] ?? "-"); ?></td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-secondary" href="<?= BASE_URL; ?>?controller=entity&action=edit&id=<?= (int) $item["id"]; ?>">Edit</a>
                                <a class="btn btn-danger" href="<?= BASE_URL; ?>?controller=entity&action=delete&id=<?= (int) $item["id"]; ?>" onclick="return confirm('Yakin hapus data ini?');">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Belum ada data <?= htmlspecialchars($moduleLabelLower); ?>.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
