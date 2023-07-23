<?php
// Démarrer la session
session_start();

// Détruire toutes les données de la session
session_destroy();

// Rediriger vers la page de connexion admin
header("Location: admin_login.php");
exit();
?>
