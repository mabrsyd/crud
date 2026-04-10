<?php require_once __DIR__ . "/../partials/header.php"; ?>

<?php $moduleLabel = $moduleLabel ?? "Relation"; ?>
<?php $moduleLabelLower = strtolower($moduleLabel); ?>
<?php $entityALabel = $entityALabel ?? "Entity A"; ?>
<?php $entityBLabel = $entityBLabel ?? "Entity B"; ?>

<section class="card">
    <div class="card-head">
        <h2><?= htmlspecialchars($title ?? ("Data " . $moduleLabel)); ?> (JOIN)</h2>
        <a class="btn" href="<?= BASE_URL; ?>?controller=relation&action=create">Tambah <?= htmlspecialchars($moduleLabel); ?></a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama <?= htmlspecialchars($entityALabel); ?></th>
                <th>Nama <?= htmlspecialchars($entityBLabel); ?></th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= (int) $item["id"]; ?></td>
                        <td><?= htmlspecialchars($item["nama_a"]); ?></td>
                        <td><?= htmlspecialchars($item["nama_b"]); ?></td>
                        <td><?= htmlspecialchars($item["tanggal"]); ?></td>
                        <td>
                            <a class="btn btn-danger" href="<?= BASE_URL; ?>?controller=relation&action=delete&id=<?= (int) $item["id"]; ?>" onclick="return confirm('Yakin hapus data relasi ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada data <?= htmlspecialchars($moduleLabelLower); ?>.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
