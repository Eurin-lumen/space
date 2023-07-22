<?php
// Configuration de la base de données
define('DB_HOST', 'localhost'); // Adresse du serveur de la base de données
define('DB_USER', 'root'); // Nom d'utilisateur de la base de données
define('DB_PASS', ''); // Mot de passe de la base de données
define('DB_NAME', 'library_management'); // Nom de la base de données

// Connexion à la base de données
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
?>
