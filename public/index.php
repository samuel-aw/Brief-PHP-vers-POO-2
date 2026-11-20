<?php

require __DIR__ . '/../config/bootstrap.php';

use App\Database;
use App\Flash;
use App\ResourceRepository;

$repository = new ResourceRepository(Database::getConnection());
$resources = $repository->findAll();
$flash = Flash::get();
$pageTitle = 'Médiathèque interne';

require __DIR__ . '/../views/index.php';
?>

