<?php

/**
 * Routeur pour le serveur de développement PHP intégré.
 * Lancer avec : php -S localhost:8000 router.php
 *
 * Ce fichier est nécessaire pour que le serveur PHP serve correctement
 * les fichiers situés dans public/ sans avoir à configurer Apache ou Nginx.
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$fichier = __DIR__ . '/public' . ($uri === '/' ? '/index.php' : $uri);

// Fichiers statiques (CSS, JS, images) → servir directement
if (is_file($fichier) && !str_ends_with($fichier, '.php')) {
    $type = mime_content_type($fichier) ?: 'application/octet-stream';
    header('Content-Type: ' . $type);
    readfile($fichier);
    return;
}

// Fichiers PHP dans public/ → les inclure
if (is_file($fichier)) {
    include $fichier;
    return;
}

// Page non trouvée
http_response_code(404);
echo '<h1>404 - Page introuvable</h1>';
