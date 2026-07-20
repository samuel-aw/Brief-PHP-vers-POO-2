<?php

session_start();

require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/functions.php';

$statement = $pdo->query('SELECT * FROM resources ORDER BY created_at DESC');
$resources = $statement->fetchAll();
$flash = get_flash();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Médiathèque interne</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<main>
    <h1>Médiathèque interne</h1>

    <?php if ($flash): ?>
        <div class="flash <?= h($flash['type']) ?>"><?= h($flash['message']) ?></div>
    <?php endif; ?>

    <p><a href="create.php">Ajouter une ressource</a></p>

    <?php if (!$resources): ?>
        <p>Aucune ressource pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Emprunteur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resources as $resource): ?>
                <tr>
                    <td><?= h($resource['title']) ?></td>
                    <td><?= h($resource['type']) ?></td>
                    <td><?= h($resource['status']) ?></td>
                    <td><?= h($resource['borrower'] ?: '-') ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?= (int) $resource['id'] ?>">Modifier</a>
                        <form method="post" action="delete.php" onsubmit="return confirm('Supprimer cette ressource ?')">
                            <input type="hidden" name="id" value="<?= (int) $resource['id'] ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
