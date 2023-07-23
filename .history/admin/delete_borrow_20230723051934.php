<?php
// delete_borrow.php

require_once '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["borrow_id"])) {
    $borrow_id = $_GET["borrow_id"];

    if (deleteBorrow($borrow_id)) {
        header("Location: borrowed_books.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression de l'emprunt.";
    }
} else {
    echo "Requête invalide.";
}
?>
