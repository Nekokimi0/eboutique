<?php
// ============================================================
// config/database.example.php — Connexion PDO à MariaDB
// ============================================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'eboutique');
define('DB_USER', 'ton_utilisateur');
define('DB_PASS', 'ton_mot_de_passe');
define('DB_CHARSET', 'utf8mb4');

// Connexion unique à la base de données
// Appelée dans le constructeur de la classe Model
function getConnexion(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }
    return $pdo;
}
?>