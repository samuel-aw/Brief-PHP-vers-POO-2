# Médiathèque interne (PHP orienté objet)

Application de gestion de ressources (livres, matériel, supports de cours…)
refactorisée du PHP procédural vers le PHP orienté objet (POO).

## Fonctionnalités

- Lister les ressources
- Ajouter, modifier et supprimer une ressource
- Messages de confirmation et d'erreur (messages flash)
- Validation des données côté serveur

## Prérequis

- PHP 8.1 ou supérieur (testé avec PHP 8.3)
- MySQL ou MariaDB (XAMPP, Laragon, WAMP ou installation autonome)
- Extension PHP `pdo_mysql` activée
- Git

## Installation

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/samuel-aw/Brief-PHP-vers-POO-2
   cd proceduralPOO2
   ```

2. Démarrer MySQL (par exemple depuis le panneau de contrôle de XAMPP).

3. Importer la base de données (crée la base `mediatheque_poo2`, la table
   `resources` et 5 ressources d'exemple) :

   ```bash
   # Linux / macOS / Git Bash
   mysql -u root -p < database/schema.sql
   ```

   ```powershell
   # Windows PowerShell (l'opérateur < n'y est pas supporté)
   mysql -u root -p -e "source database/schema.sql"
   ```

   Alternative : dans phpMyAdmin, onglet **Importer**, choisir `database/schema.sql`.

4. Créer le fichier de configuration à partir du modèle :
   ```bash
   cp config/database.example.php config/database.php
   ```
   (Windows : `copy config\database.example.php config\database.php`)

## Configuration

Modifier `config/database.php` selon son environnement :

```php
return [
    'host'     => 'localhost',
    'database' => 'mediatheque_poo2',
    'username' => 'root',
    'password' => '',
];
```

Ce fichier contient les identifiants : il est dans `.gitignore` et n'est pas
versionné. Il est situé hors du dossier `public/`, donc inaccessible depuis
le navigateur.

## Lancement

Depuis la racine du projet :

```bash
php -S localhost:8000 router.php
```

Puis ouvrir http://localhost:8000 dans le navigateur.

## Structure du projet

```
├── config/
│   ├── bootstrap.php           Session + autoloader + chargement des helpers
│   ├── database.php            Identifiants MySQL (non versionné)
│   └── database.example.php    Modèle de configuration
├── database/
│   └── schema.sql              Création de la base et données d'exemple
├── public/                     Seul dossier accessible depuis le navigateur
│   ├── assets/style.css
│   ├── index.php               Liste
│   ├── create.php              Ajout
│   ├── edit.php                Modification
│   └── delete.php              Suppression
├── src/                        Classes (namespace App)
│   ├── Database.php
│   ├── Flash.php
│   ├── Resource.php
│   ├── ResourceRepository.php
│   ├── Validator.php
│   └── helpers.php
├── views/                      Affichage HTML
│   ├── index.php, create.php, edit.php
│   └── partials/               header, footer, flash, resource_form
├── router.php                  Routeur du serveur de développement PHP
└── README.md
```

## Description des classes

| Classe | Rôle |
|---|---|
| `Database` | Crée et fournit la connexion PDO unique (singleton). Seule classe qui lit la configuration. |
| `Resource` | Représente une ressource (propriétés typées). Contient la liste des statuts autorisés (`STATUSES`) et la méthode `fromArray()` qui transforme un tableau en objet. |
| `ResourceRepository` | Contient toutes les requêtes SQL : `findAll`, `find`, `create`, `update`, `delete`. |
| `Validator` | Contrôle les données d'un formulaire et retourne la liste des erreurs. |
| `Flash` | Stocke un message en session pour l'afficher une seule fois après une redirection. |

Les fichiers de `public/` jouent le rôle de contrôleurs : ils récupèrent la
requête, appellent les classes, puis chargent une vue. Ils ne contiennent ni
SQL ni HTML.

## Sécurité

- Requêtes préparées PDO (protection contre l'injection SQL)
- Validation côté serveur avant toute insertion ou modification
- Échappement de toutes les données affichées avec `htmlspecialchars` (fonction `h()`)
- Identifiants de connexion hors du dossier public et exclus de Git
- Suppression uniquement par requête POST

## Tester le CRUD

1. La liste affiche les ressources.
2. Ajouter une ressource valide : message vert, ressource visible.
3. Envoyer un titre vide : message d'erreur, valeurs conservées.
4. Modifier une ressource : message de confirmation.
5. Ouvrir `edit.php?id=9999` : message « Ressource introuvable ».
6. Supprimer une ressource : confirmation, puis la ligne disparaît.