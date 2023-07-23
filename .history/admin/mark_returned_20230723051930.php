<?php
// mark_returned.php

require_once '../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["borrow_id"])) {
    $borrow_id = $_GET["borrow_id"];

    if (markBorrowAsReturned($borrow_id)) {
        header("Location: borrowed_books.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la mise à jour du statut de l'emprunt.";
    }
} else {
    echo "Requête invalide.";
}
?>
