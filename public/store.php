<?php

session_start();

require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/functions.php';

$errors = validate_resource($_POST);

if ($errors) {
    set_flash('error', implode(' ', $errors));
    redirect('create.php');
}

$statement = $pdo->prepare(
    'INSERT INTO resources (title, type, status, borrower) VALUES (:title, :type, :status, :borrower)'
);

$statement->execute([
    'title' => trim($_POST['title']),
    'type' => trim($_POST['type']),
    'status' => $_POST['status'],
    'borrower' => trim($_POST['borrower'] ?? '') ?: null,
]);

set_flash('success', 'Ressource ajoutée.');
redirect('index.php');
