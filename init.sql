CREATE TABLE Administrateur (
    id_administrateur INT AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,

    PRIMARY KEY(id_admin),
    UNIQUE KEY login (login)
);

CREATE TABLE Utilisateur (
    id_utilisateur INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    telephone VARCHAR(15),
    adresse VARCHAR(255),
    mot_de_passe VARCHAR(255) NOT NULL,

    PRIMARY KEY(id_utilisateur)
);

CREATE TABLE Categorie_Produit (
    id_categorie_produit INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,

    PRIMARY KEY(id_categorie_produit)
);

CREATE TABLE Produit (
    id_produit INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    image VARCHAR(255),
    prix DECIMAL(10,2) NOT NULL,
    quantite INT NOT NULL,
    description TEXT,
    id_categorie_produit INT NOT NULL,

    PRIMARY KEY(id_produit),
    FOREIGN KEY (id_categorie_produit) REFERENCES Categorie_Produit(id_categorie_produit)
);

CREATE TABLE Commande (
    id_commande INT AUTO_INCREMENT,
    date DATE NOT NULL,
    statut ENUM('En attente', 'Refusé', 'Accepté') NOT NULL DEFAULT 'En attente',
    statut_livraison ENUM('En attente', 'Livré', 'Non livré') NOT NULL DEFAULT 'En attente',
    prix_total DECIMAL(10,2) NOT NULL,
    id_utilisateur INT NOT NULL,

    PRIMARY KEY(id_commande),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
);

CREATE TABLE Ligne_Commande (
    id_ligne INT AUTO_INCREMENT,
    quantite INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    id_commande INT NOT NULL,
    id_produit INT NOT NULL,

    PRIMARY KEY(id_ligne),
    FOREIGN KEY (id_commande) REFERENCES Commande(id_commande),
    FOREIGN KEY (id_produit) REFERENCES Produit(id_produit)
);
