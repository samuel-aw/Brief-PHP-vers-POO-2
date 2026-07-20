<?php

session_start();

require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    set_flash('error', 'Méthode non autorisée.');
    redirect('index.php');
}

$id = (int) ($_POST['id'] ?? 0);

$statement = $pdo->prepare('DELETE FROM resources WHERE id = :id');
$statement->execute(['id' => $id]);

set_flash('success', 'Ressource supprimée.');
redirect('index.php');
