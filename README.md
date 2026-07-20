# Médiathèque interne - Version procédurale

Application de départ pour le brief "Remettre de l'ordre dans la médiathèque interne".

Cette version est volontairement écrite en PHP procédural. Les apprenants doivent la refactoriser en PHP POO.

## Installation

1. Importer la base :

```bash
mysql -u root -p < database/schema.sql
```

2. Adapter `config/database.php` si besoin.

3. Lancer le serveur local depuis la racine du projet :

```bash
php -S localhost:8000 router.php
```

4. Ouvrir :

```text
http://localhost:8000
```

> Le fichier `router.php` est nécessaire pour que le serveur PHP trouve correctement les pages dans `public/`. Ne pas utiliser `php -S localhost:8000 -t public` seul, cela provoquerait des erreurs 404 sur les liens.

## Fonctionnalités présentes

- Liste des ressources.
- Ajout d'une ressource.
- Modification d'une ressource.
- Suppression d'une ressource.
- Messages de succès ou d'erreur en session.
- Validation serveur minimale.

## Mission apprenant

Transformer cette application en PHP POO sans changer son comportement fonctionnel.
