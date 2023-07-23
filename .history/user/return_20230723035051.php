<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    $user_id = $_SESSION['user_id'];

    // Retourner le livre
    if (returnBook($user_id, $bookId)) {
        header('Location: profile.php');
        exit();
    } else {
        echo "Une erreur s'est produite lors du retour du livre. Veuillez réessayer.";
    }
} else {
    echo "Livre non spécifié. Veuillez sélectionner un livre à retourner.";
}
?>
