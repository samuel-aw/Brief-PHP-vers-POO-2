<?php require __DIR__ . '/partials/header.php'; ?>

<h1>Médiathèque interne</h1>

<?php require __DIR__ . '/partials/flash.php'; ?>

<p><a href="create.php">Ajouter une ressource</a></p>

<?php if (!$resources): ?>
    <p>Aucune ressource pour le moment</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Titre</th><th>Type</th><th>Statut</th><th>Emprunteur</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($resources as $resource): ?>
            <tr>
                <td><?= h($resource->title) ?></td>
                <td><?= h($resource->type) ?></td>
                <td><?= h($resource->status) ?></td>
                <td><?= h($resource->borrower ?? '-') ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?= (int) $resource->id ?>">Modifier</a>
                    <form method="post" action="delete.php" onsubmit="return confirm('Supprimer cette ressource ?')">
                        <input type="hidden" name="id" value="<?= (int) $resource->id ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/partials/footer.php'; ?>