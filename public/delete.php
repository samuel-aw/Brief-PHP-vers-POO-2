<?php

require __DIR__ . '/../config/bootstrap.php';

use App\Database;
use App\Flash;
use App\ResourceRepository;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Flash::set('error', 'Méthode non autorisée.');
    redirect('index.php');
}

$repository = new ResourceRepository(Database::getConnection());
$repository->delete((int) ($_POST['id'] ?? 0));

Flash::set('success', 'Resource supprimée');
redirect('index.php');
