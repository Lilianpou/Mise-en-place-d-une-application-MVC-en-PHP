-- Création de la base de données
CREATE DATABASE IF NOT EXISTS mvc_app_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mvc_app_db;

-- Création de la table agences
CREATE TABLE IF NOT EXISTS agences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Création de la table users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
) ENGINE=InnoDB;

-- Création de la table trajets
CREATE TABLE IF NOT EXISTS trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agence_depart_id INT NOT NULL,
    agence_arrivee_id INT NOT NULL,
    date_heure_depart DATETIME NOT NULL,
    date_heure_arrivee DATETIME NOT NULL,
    places_totales INT NOT NULL,
    places_prises INT DEFAULT 0,
    contact_id INT NOT NULL,
    FOREIGN KEY (agence_depart_id) REFERENCES agences(id) ON DELETE CASCADE,
    FOREIGN KEY (agence_arrivee_id) REFERENCES agences(id) ON DELETE CASCADE,
    FOREIGN KEY (contact_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Insertion des agences
INSERT INTO agences (nom) VALUES 
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- Insertion des utilisateurs
INSERT INTO users (nom, prenom, telephone, email, password, role) VALUES 
('Test', 'User', '0600000001', 'test1@email.fr', '1234', 'user'), 
('Test', 'Admin', '0600000002', 'test2@email.fr', '1234', 'admin'), 
('Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', '1234', 'user'),
('Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', '1234', 'user'),
('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', '1234', 'user'),
('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', '1234', 'user'),
('Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', '1234', 'user'),
('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', '1234', 'user'),
('Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', '1234', 'user'),
('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', '1234', 'user'),
('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', '1234', 'user'),
('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', '1234', 'user'),
('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', '1234', 'user'),
('Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', '1234', 'user'),
('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', '1234', 'user'),
('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', '1234', 'user'),
('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', '1234', 'user'),
('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', '1234', 'user'),
('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', '1234', 'user'),
('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', '1234', 'user'),
('Masson', 'Julie', '0733445566', 'julie.masson@email.fr', '1234', 'user'),
('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', '1234', 'user');