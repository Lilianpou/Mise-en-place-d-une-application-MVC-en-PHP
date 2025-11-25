# Touche pas au klaxon - Application de Covoiturage MVC

Ce projet est une application de covoiturage développée en PHP natif respectant l'architecture **MVC (Modèle-Vue-Contrôleur)**. Elle permet aux utilisateurs de proposer et de consulter des trajets entre différentes agences.

## 🚀 Fonctionnalités

### 👤 Gestion des Utilisateurs (Authentification)

- **Connexion / Déconnexion** sécurisée.
- Gestion des sessions.
- Hachage des mots de passe (compatible avec les données de test en clair).

### 🚗 Gestion des Trajets

- **Visiteur** :
  - Consultation de la liste des trajets disponibles.
  - Invitation à se connecter pour voir les détails.
- **Utilisateur Connecté** :
  - **Création de trajet** : Formulaire avec pré-remplissage des données utilisateur et contrôles de cohérence (dates, lieux différents).
  - **Consultation** : Voir les détails du conducteur (Nom, Téléphone, Email) via une fenêtre modale.
  - **Gestion** : Modifier ou supprimer **uniquement ses propres trajets**.
- **Administrateur** :
  - Voir tous les trajets et leurs détails.
  - **Supprimer** n'importe quel trajet (modération).
  - _Note : L'admin ne peut pas modifier les trajets des autres utilisateurs._

### 🏢 Gestion des Agences (Admin uniquement)

- Liste des agences.
- **CRUD complet** : Ajouter, Modifier, Supprimer une agence.

### 👥 Gestion des Utilisateurs (Admin uniquement)

- Consultation de la liste des inscrits (Nom, Prénom, Email, Rôle).

## 🛠️ Technologies utilisées

- **Langage** : PHP 8+
- **Base de données** : MySQL
- **Frontend** : HTML5, CSS3, **Bootstrap 5** (Responsive Design), FontAwesome.
- **Architecture** : MVC (Custom Router).

## ⚙️ Installation

1. **Cloner le projet**

   ```bash
   git clone <url_du_depot>
   ```

2. **Base de données**

   - Ouvrez votre gestionnaire de base de données (phpMyAdmin, Workbench, etc.).
   - Importez le fichier `database.sql` situé à la racine du projet.
   - Cela créera la base `mvc_app_db` et les tables nécessaires avec des données de test.

3. **Configuration**

   - Vérifiez les identifiants de connexion dans `config/database.php` :
     ```php
     private $host = "localhost";
     private $db_name = "mvc_app_db";
     private $username = "root";
     private $password = ""; // Mettre votre mot de passe si nécessaire
     ```

4. **Lancement**
   - Placez le dossier du projet dans votre répertoire serveur (ex: `htdocs` pour XAMPP ou `www` pour WAMP).
   - Accédez à l'application via votre navigateur : `http://localhost/NomDuDossier/`

## 📂 Structure du projet

```
/
├── assets/          # Fichiers statiques (CSS, JS, Images)
├── config/          # Configuration (Connexion BDD)
├── controllers/     # Logique de l'application (C de MVC)
├── models/          # Interaction avec la BDD (M de MVC)
├── views/           # Fichiers d'affichage (V de MVC)
│   ├── agences/     # Vues pour la gestion des agences
│   ├── auth/        # Vues pour la connexion
│   ├── home/        # Vue principale (Liste des trajets)
│   ├── trajet/      # Vues pour la création/édition de trajets
│   └── users/       # Vue pour la liste des utilisateurs
├── index.php        # Point d'entrée (Routeur)
└── database.sql     # Script SQL d'initialisation
```

## 🧪 Comptes de Test

Vous pouvez utiliser les comptes suivants pour tester l'application (Mots de passe : `1234`) :

| Rôle      | Email            | Mot de passe |
| --------- | ---------------- | ------------ |
| **Admin** | `test2@email.fr` | `1234`       |
| **User**  | `test1@email.fr` | `1234`       |

---

© 2024 - CENEF - MVC PHP
