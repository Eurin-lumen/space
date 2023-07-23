<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si l'administrateur est connecté
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
    header('Location: admin_login.php');
    exit();
}

// Traitement du formulaire d'ajout de livre
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $domain = $_POST['domain'];
    $description = $_POST['description'];
    $copies = $_POST['copies'];

    // Vérifier si l'image a été téléchargée avec succès
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target = '../images/' . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = null;
    }

    // Vérifier si le fichier PDF a été téléchargé avec succès
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf = $_FILES['pdf']['name'];
        $target = '../pdf/' . $pdf;
        move_uploaded_file($_FILES['pdf']['tmp_name'], $target);
    } else {
        $pdf = null;
    }

    // Ajouter le livre dans la base de données
    if (addBook($title, $author, $domain, $description, $copies, $image, $pdf)) {
        // Rediriger vers le tableau de bord de l'administrateur avec un message de succès
        header('Location: admin_dashboard.php?message=Le livre a été ajouté avec succès');
        exit();
    } else {
        // Rediriger vers la page d'ajout de livre avec un message d'erreur
        header('Location: add_book.php?error=Une erreur s\'est produite lors de l\'ajout du livre');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Livre</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <header>
        <h1>Ajouter un Livre</h1>
    </header>

    <main>
        <div class="admin-container">
            <form action="add_book.php" method="post" enctype="multipart/form-data">
                <label for="title">Titre :</label>
                <input type="text" name="title" required>
                
                <label for="author">Auteur :</label>
                <input type="text" name="author" required>
                
                <label for="domain">Domaine :</label>
                <input type="text" name="domain" required>
                
                <label for="description">Description :</label>
                <textarea name="description" required></textarea>
                
                <label for="copies">Exemplaires disponibles :</label>
                <input type="number" name="copies" required>

                <label for="image">Image :</label>
                <input type="file" name="image">

                <label for="pdf">Fichier PDF :</label>
                <input type="file" name="pdf">

                <input type="submit" name="submit" value="Ajouter">
            </form>
        </div>
    </main>
</body>
</html>
